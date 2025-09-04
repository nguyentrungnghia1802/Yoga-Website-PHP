<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCustomerRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route('customer')->id ?? null;

        return [
            'name'      => ['sometimes','required','string','max:100'],
            'phone'     => ['sometimes','required','string','max:20', Rule::unique('customers','phone')->ignore($id)],
            'email'     => ['sometimes','required','email','max:100', Rule::unique('customers','email')->ignore($id)],
            'birthday'  => ['sometimes','required','date'],
            'gender' => ['sometimes','required','string','max:10', 'in:male,female,other'],
            'address'   => ['nullable','string','max:255'],
            'note'      => ['nullable','string','max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Customer name is required.',
            'phone.required'    => 'Phone number is required.',
            'phone.unique'      => 'Phone number already exists.',
            'email.required'    => 'Email is required.',
            'email.email'       => 'Email must be a valid email address.',
            'email.unique'      => 'Email already exists.',
            'birthday.required' => 'Birthday is required.',
            'birthday.date'     => 'Birthday must be a valid date.',
            'gender.required'   => 'Gender is required.',
            'gender.in'         => 'Gender must be male, female, or other.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422)
        );
    }
}
