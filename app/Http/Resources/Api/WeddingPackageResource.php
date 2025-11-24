<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeddingPackageResource extends JsonResource
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
            "name" => $this->name,
            "slug" => $this->slug,
            "price" => $this->price,
            "isPopular" => $this->is_Popular,
            "thumbnail" => $this->thumbnail,
            "about" => $this->about,

            // Using new in here because we just want a single object
            "city" => new CityResource($this->whenLoaded("city")),
            "weddingOrganizer" => new WeddingOrganizerResource($this->whenLoaded("weddingOrganizer")),

            // Using Collections in here because each Wedding Package has many Wedding Photo, Bonus Packages, and Testimonials
            "photos" => WeddingPhotoResource::collection($this->whenLoaded("photos")),
            "weddingBonusPackages" => WeddingBonusPackageResource::collection($this->whenLoaded("weddingBonusPackages")),
            "weddingTestimonials" => WeddingTestimonialResource::collection($this->whenLoaded("weddingTestimonials")),
        ];
    }
}
