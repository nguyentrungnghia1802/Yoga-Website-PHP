<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'teacher_id' => ['sometimes','required','exists:teachers,id'],
            'name'       => ['sometimes','required','string','max:100'],
            'lich_hoc'   => ['sometimes','required','string','max:50'],
            'start_time' => ['sometimes','required','date_format:H:i'],
            'end_time'   => ['sometimes','required','date_format:H:i','after:start_time'],
            'start_date' => ['sometimes','required','date'],
            'end_date'   => ['sometimes','required','date','after_or_equal:start_date'],
            'quantity'   => ['sometimes','required','integer','min:1','max:1000'],
            'price'      => ['sometimes','required','numeric','min:0'],
            'location'   => ['sometimes','required','string','max:100'],
            'description'=> ['sometimes','required','string','max:255'],
        ];
    }
}
