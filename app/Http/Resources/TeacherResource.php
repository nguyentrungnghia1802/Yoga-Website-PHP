<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TeacherResource extends JsonResource
{
    public function toArray($request): array
    {
        $avatar = $this->avatar;

        if ($avatar && !str_starts_with($avatar, 'http')) {
            $avatar = Storage::disk('public')->url($avatar);
        }

        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'phone'       => $this->phone,
            'email'       => $this->email,
            'birthday'    => $this->birthday?->toDateString(),
            'exp_year'    => (int) $this->exp_year,
            'description' => $this->description,
            'avatar'      => $avatar,
            'created_at'  => optional($this->created_at)->toDateTimeString(),
            'updated_at'  => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
