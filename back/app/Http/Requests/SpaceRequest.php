<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

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
 *     @OA\Property(property="status", type="boolean", description="Status of the space"),
 * )
 */
class SpaceRequest extends FormRequest
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
        $validations = [];
        if ($this->isMethod('post')) {
            $validations = [
                'name' => 'required|string|max:255|unique:spaces,name',
                'description' => 'nullable|string',
                'capacity' => 'required|integer',
                'type_id' => 'required|exists:types,id',
                'photos' => 'nullable|string',
            ];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $spaceId = $this->route('space');
            $validations = [
                'name' => ['required', 'string', 'max:255', Rule::unique('spaces', 'name')->ignore($spaceId)],
                'description' => 'nullable|string',
                'capacity' => 'required|integer|min:1|max:99999',
                'type_id' => 'required|exists:types,id',
                'photos' => 'nullable|string',
                'status' => 'nullable|boolean',
            ];
        }
        return $validations;
    }
}
