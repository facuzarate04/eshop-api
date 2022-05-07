<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryMethodSpecificationResource extends JsonResource
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
            'price' => $this->price,
            'delay_time' => $this->delay_time,
            'deliveryMethod' => DeliveryMethodResource::make($this->whenLoaded('deliveryMethod')),
            'origin' => $this->whenLoaded('origin'),
            'destination' => $this->whenLoaded('destination')
        ];
    }
}
