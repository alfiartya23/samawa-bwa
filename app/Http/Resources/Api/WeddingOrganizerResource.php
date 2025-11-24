<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeddingOrganizerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->id,
            "slug" => $this->id,
            "phone" => $this->id,
            "icon" => $this->id,
            "weddingPackages_count" => $this->weddingPackages_count,
            "weddingPackages" => new WeddingPackageResource($this->whenLoaded('weddingPackages'))
        ];
    }
}
