<?php

namespace App\Http\Requests\Reservation;

use App\Enums\StatusReservationEnum;
use App\Models\Reservation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ReservationUpdateRequest",
 *     type="object",
 *     required={"user_id", "space_id", "event_name", "date", "start_time", "end_time"},
 *     @OA\Property(property="user_id", type="integer", description="ID del usuario que hace la reservación."),
 *     @OA\Property(property="space_id", type="integer", description="ID del espacio a reservar."),
 *     @OA\Property(property="event_name", type="string", description="Nombre del evento.", minLength=1, maxLength=50),
 *     @OA\Property(property="status", type="string", 
 *     description="Estados que pueda tener la reserva: 'pendiente', 'confirmado', 'cancelado', 'completado', 'no utilizado'.", 
 *     example="pendiente"),
 *     @OA\Property(property="date", type="string", description="Fecha de la reservación en formato Y-m-d.", example="2024-10-15"),
 *     @OA\Property(property="start_time", type="string", description="Hora de inicio del evento en formato H:i.", example="14:00"),
 *     @OA\Property(property="end_time", type="string", description="Hora de finalización del evento en formato H:i.", example="16:00"),
 * )
 */
class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $reservationId = $this->route('reservation');
        $spaceId = $reservationId->space_id;
        return [
            'user_id' => 'required|integer|exists:users,id',
            'space_id' => ['required', 'integer', 'exists:spaces,id', function ($attribute, $value, $fail) use($spaceId) {
                    if ($this->space_id !== $spaceId) {
                        $this->checkSpaceAvailability($attribute, $value, $fail);
                    }
                },
            ],
            'event_name' => ['required', 'string', 'min:1', 'max:50', Rule::unique('reservations', 'event_name')->ignore($reservationId) ],
            'date' => 'required|date|date_format:Y-m-d',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|string|in:' . implode(',', StatusReservationEnum::statusArray()),
        ];
    }

    public function checkSpaceAvailability($attribute, $value, $fail)
    {
        $conflictingReservation = Reservation::where('space_id', $value)
        ->where('date', $this->date)
        ->where(function ($query) {
            $query->whereBetween('start_time', [$this->start_time, $this->end_time])
                  ->orWhereBetween('end_time', [$this->start_time, $this->end_time])
                  ->orWhere(function ($query) {
                      $query->where('start_time', '<=', $this->start_time)
                            ->where('end_time', '>=', $this->end_time);
                  });
        })
        ->whereIn('status', [StatusReservationEnum::PENDING->value, StatusReservationEnum::CONFIRMED->value])
        ->exists();

        if ($conflictingReservation) {
            $fail('El espacio ya está reservado para esta fecha y hora.');
        }
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => 'El campo usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no es válido.',
            'space_id.required' => 'El campo espacio es obligatorio.',
            'space_id.exists' => 'El espacio seleccionado no es válido.',
            'event_name.required' => 'El campo nombre del evento es obligatorio.',
            'event_name.unique' => 'El nombre del evento ya está en uso. Por favor, elige uno diferente.',
            'date.required' => 'El campo fecha es obligatorio.',
            'date.date' => 'El campo fecha debe ser una fecha válida.',
            'date.date_format' => 'El campo fecha debe estar en el formato Y-m-d.',
            'start_time.required' => 'El campo hora de inicio es obligatorio.',
            'start_time.date_format' => 'El campo hora de inicio debe estar en el formato H:i.',
            'end_time.required' => 'El campo hora de fin es obligatorio.',
            'end_time.date_format' => 'El campo hora de fin debe estar en el formato H:i.',
            'end_time.after' => 'La hora de fin debe ser posterior a la hora de inicio.',
            'status.required' => 'El estado es obligatorio.',
            'status.in' => 'El estado debe ser uno de los siguientes: ' . implode(', ', StatusReservationEnum::statusArray()),
        ];
    }
}
