<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'customer_id'    => $this->customer_id,
            'class_id'       => $this->class_id,
            'package_months' => (int) $this->package_months,
            'discount'       => (float) $this->discount,
            'final_price'    => (float) $this->final_price,
            'status'         => is_string($this->status) ? $this->status : $this->status->value,
            'note'           => $this->note,
            'customer'       => $this->whenLoaded('customer', fn() => [
                'id'    => $this->customer->id,
                'name'  => $this->customer->name,
                'phone' => $this->customer->phone,
                'email' => $this->customer->email,
            ]),
            'class'          => $this->whenLoaded('class', fn() => [
                'id'       => $this->class->id,
                'name'     => $this->class->name,
                'quantity' => (int) $this->class->quantity,
                'price'    => (float) $this->class->price,
            ]),
            'created_at'     => optional($this->created_at)->toDateTimeString(),
            'updated_at'     => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
