<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class UnifiedRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'class_id'       => ['required', 'exists:classes,id'],
            'package_months' => ['required', 'in:1,3,6,12'],
            'note'           => ['nullable', 'string', 'max:255'],

            'customer_id'         => ['nullable', 'exists:customers,id'],
            'customer.name'       => ['required_without:customer_id', 'string', 'max:100'],
            'customer.phone'      => ['required_without:customer_id', 'string', 'max:20'],
            'customer.email'      => ['nullable', 'email', 'max:100'],
            'customer.birthday'   => ['nullable', 'date'],
//            'customer.gender'  => ['nullable', 'string', 'max:10'],
            'customer.gender'    => ['required_without:customer_id', 'in:male,female,other'],
            'customer.address'    => ['nullable', 'string', 'max:255'],
            'customer.note'       => ['nullable', 'string', 'max:255'],

            'idempotency_key'     => ['nullable', 'string', 'max:64'],
        ];
    }

    public function messages(): array
    {
        return [
            'class_id.required'          => 'Thiếu class_id.',
            'class_id.exists'            => 'Lớp không tồn tại.',
            'package_months.in'          => 'Gói tháng chỉ nhận 1, 3, 6 hoặc 12.',
            'customer_id.exists'         => 'Khách hàng không tồn tại.',
            'customer.name.required_without'   => 'Tên khách hàng là bắt buộc khi không có customer_id.',
            'customer.phone.required_without'  => 'Số điện thoại là bắt buộc khi không có customer_id.',
            'customer.gender.required_without' => 'Giới tính là bắt buộc khi không có customer_id.',
            'customer.gender.in'               => 'Giới tính phải là male, female hoặc other.',
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

    protected function prepareForValidation(): void
    {
        if ($this->has('customer')) {
            $customer = (array) $this->input('customer', []);
            if (isset($customer['email'])) {
                $customer['email'] = strtolower(trim((string) $customer['email']));
            }
            if (isset($customer['phone'])) {
                $customer['phone'] = preg_replace('/\s+/', '', (string) $customer['phone']);
            }
            $this->merge(['customer' => $customer]);
        }
    }
}
