<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function rules(): array {
        return [
            'customer_id'    => ['required','exists:customers,id'],
            'class_id'       => ['required','exists:classes,id'],
            'package_months' => ['required','in:1,3,6,12'],
            'note'           => ['nullable','string','max:255'],
        ];
    }
}
