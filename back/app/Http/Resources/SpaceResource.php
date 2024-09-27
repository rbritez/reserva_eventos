<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

class SpaceResource extends JsonResource
{
    /**
    * 
    * @OA\Schema(
    *     schema="SpaceResource",
    *     type="object",
    *     @OA\Property(property="id", type="integer", format="int64", description="ID of the space"),
    *     @OA\Property(property="name", type="string", description="Name of the space"),
    *     @OA\Property(property="description", type="string", description="Description of the space"),
    *     @OA\Property(property="capacity", type="integer", description="Capacity of the space"),
    *     @OA\Property(property="type_name", type="string", description="Type name of the space"),
    *     @OA\Property(property="photos", type="string", description="Photos of the space"),
    *     @OA\Property(property="status", type="boolean", description="Status of the space"),
    *     @OA\Property(property="type", type="string", description="Type name of the space"),
    *     @OA\Property(property="created_at", type="string", format="date-time", description="Creation timestamp"),
    *     @OA\Property(property="updated_at", type="string", format="date-time", description="Update timestamp")
    * )
    * 
    * 
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'capacity' => $this->capacity,
            'type_name' => $this->type->name,
            'photos' => $this->photos,
            'status' => $this->status,
            'type' => $this->type?->name,
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString()
        ];
    }
}
