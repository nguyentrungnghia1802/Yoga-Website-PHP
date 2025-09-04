<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route('teacher')->id ?? null;

        return [
            'name'        => ['sometimes','required','string','max:100'],
            'phone'       => ['sometimes','required','string','max:20', Rule::unique('teachers','phone')->ignore($id)],
            'email'       => ['sometimes','required','email','max:100', Rule::unique('teachers','email')->ignore($id)],
            'birthday'    => ['sometimes','required','date'],
            'exp_year'    => ['sometimes','required','integer','min:0','max:80'],
            'description' => ['sometimes','required','string','max:255'],
            'avatar'      => ['sometimes','required','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ];
    }
}
