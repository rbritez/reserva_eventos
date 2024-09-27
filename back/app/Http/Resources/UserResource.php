<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

class UserResource extends JsonResource
{
    /**
     * 
     * @OA\Schema(
     *     schema="UserResource",
     *     type="object",
     *     @OA\Property(property="id", type="integer", format="int64", description="ID of the user"),
     *     @OA\Property(property="name", type="string", description="Name of the user"),
     *     @OA\Property(property="email", type="string", description="Email of the user"),
     * )
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
            'email' => $this->email 
        ];
    }
}
