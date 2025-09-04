<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClazzResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'teacher_id'  => $this->teacher_id,
            'name'        => $this->name,
            'lich_hoc'    => $this->lich_hoc,
            'start_time'  => $this->start_time,
            'end_time'    => $this->end_time,
            'start_date'  => $this->start_date?->toDateString(),
            'end_date'    => $this->end_date?->toDateString(),
            'quantity'    => (int) $this->quantity,
            'price'       => (float) $this->price,
            'location'    => $this->location,
            'description' => $this->description,
            'teacher'     => $this->whenLoaded('teacher', fn() => [
                'id'    => $this->teacher->id,
                'name'  => $this->teacher->name,
                'email' => $this->teacher->email,
                'phone' => $this->teacher->phone,
            ]),
            'created_at'  => optional($this->created_at)->toDateTimeString(),
            'updated_at'  => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
