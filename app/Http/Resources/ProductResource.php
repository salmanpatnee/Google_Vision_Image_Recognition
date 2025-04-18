<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, 
            'name' => $this->name, 
            'description' => $this->description, 
            'price' => $this->price, 
            'image_url' => !is_null($this->image) ? asset($this->image) : asset('images/no-image.png') ,
            'category' => $this->whenLoaded('category', fn () => new CategoryResource($this->category)), 
            'tags' => $this->whenLoaded('tags', fn () => TagResource::collection($this->tags))
        ];
    }
}
