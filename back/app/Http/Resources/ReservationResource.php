<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ReservationResource",
 *     type="object",
 *     @OA\Property(property="id", type="integer", description="ID de la reserva"),
 *     @OA\Property(property="user", ref="#/components/schemas/UserResource"),
 *     @OA\Property(property="space", ref="#/components/schemas/SpaceResource"),
 *     @OA\Property(property="date", type="string", description="Fecha de la reserva en formato Y-m-d"),
 *     @OA\Property(property="start_time", type="string", description="Hora de inicio en formato H:i"),
 *     @OA\Property(property="end_time", type="string", description="Hora de finalización en formato H:i"),
 *     @OA\Property(property="status", type="string", description="Estado de la reserva"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Fecha de creación de la reserva"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Fecha de actualización de la reserva")
 * )
 */
class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'space' => new SpaceResource($this->space),
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status' => strtoupper($this->status),
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString()
        ];
    }
}
