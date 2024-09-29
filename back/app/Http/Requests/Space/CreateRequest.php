<?php

namespace App\Http\Requests\Space;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StoreSpaceRequest",
 *     type="object",
 *     required={"name", "capacity", "type_id"},
 *     @OA\Property(property="name", type="string", description="Name of the space"),
 *     @OA\Property(property="description", type="string", description="Description of the space"),
 *     @OA\Property(property="capacity", type="integer", description="Capacity of the space"),
 *     @OA\Property(property="type_id", type="integer", description="Type ID of the types spaces API."),
 *     @OA\Property(property="photos", type="string", description="Photos of the space"),
 * )
 */
class CreateRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255|unique:spaces,name',
            'description' => 'nullable|string',
            'capacity' => 'required|integer',
            'type_id' => 'required|exists:types,id',
            'photos' => 'nullable|string',
        ];
    }
}
