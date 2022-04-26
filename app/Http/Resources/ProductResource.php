<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
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
            'status' => $this->status,
            'price' => $this->price,
            'stock' => $this->stock,
            'images' => ImageResource::collection($this->whenLoaded('images')),
            'subCategory' => SubCategoryResource::make($this->whenLoaded('subCategory')),
            'preview_image' => $this->preview_image,
        ];
    }
}
