<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'phone'     => $this->phone,
            'email'     => $this->email,
            'birthday'  => $this->birthday?->toDateString(),
            'gender' => $this->gioi_tinh,
            'address'   => $this->address,
            'note'      => $this->note,
            'created_at'=> optional($this->created_at)->toDateTimeString(),
            'updated_at'=> optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
