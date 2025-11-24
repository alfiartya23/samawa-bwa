<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeddingTestimonialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "id" => $this->id,
            "name" => $this->name,
            "occupation" => $this->occupation,
            "photo" => $this->photo,
            "message" => $this->message,
            "weddingPackages" => new WeddingPackageResource($this->whenLoaded('weddingPackages'))
        ];
    }
}
