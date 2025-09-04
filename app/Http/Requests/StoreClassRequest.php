<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreClassRequest extends FormRequest
{
    public function rules(): array {
        return [
            'teacher_id' => ['required','exists:teachers,id'],
            'name'       => ['required','string','max:100'],
            'lich_hoc'   => ['required','string','max:50'],
            'start_time' => ['required','date_format:H:i'],
            'end_time'   => ['required','date_format:H:i','after:start_time'],
            'start_date' => ['required','date'],
            'end_date'   => ['required','date','after_or_equal:start_date'],
            'quantity'   => ['required','integer','min:1','max:1000'],
            'price'      => ['required','numeric','min:0'],
            'location'   => ['required','string','max:100'],
            'description'=> ['required','string','max:255'],
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
