<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

class TypeResource extends JsonResource
{
    /**
     *  
     * @OA\Schema(
     *     schema="TypeSpaceResource",
     *     type="object",
     *     @OA\Property(property="id", type="integer", format="int64", description="ID of the type"),
     *     @OA\Property(property="name", type="string", description="Name of the type"),
     * )
     * 
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
