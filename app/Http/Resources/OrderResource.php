<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'created_at' => date_format($this->created_at, 'd-m-y h:i:s a'),
            'number' => $this->number, 
            'price_paid' => $this->price_paid,
            'user' => $this->whenLoaded('user'),
            'status' => $this->whenLoaded('status'),
            'paymentMethod' => $this->whenLoaded('paymentMethod'),
            'deliveryMethodSpecification' => $this->whenLoaded('deliveryMethodSpecification'),
            'products' => $this->whenLoaded('products')
        ];
    }
}
