<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRegistrationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'customer_id'    => ['sometimes','required','exists:customers,id'],
            'class_id'       => ['sometimes','required','exists:classes,id'],
            'package_months' => ['sometimes','required','in:1,3,6,12'],
            'note'           => ['nullable','string','max:255'],
        ];
    }
}
