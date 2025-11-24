<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    // This method changing model into Array
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "icon" => $this->icon,
            "weddingPackages_count" => $this->wedding_packages_count,

            // Collection here were to show wedding package from each city
            // dan ketika di controller/service kita ambil, maka akan sekaligus mengambil relasi weddingPackages dari model City sebelumnya
            "weddingPackages" => WeddingPackageResource::collection($this->whenLoaded("weddingPackages")),
        ];
    }
}
