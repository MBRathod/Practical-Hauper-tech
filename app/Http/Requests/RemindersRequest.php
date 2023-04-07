<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class RemindersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'       =>  'required|regex:/^[a-zA-Z]+$/u',
            'description'      =>  'required',
            'schedule_date_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'       => 'Please Enter Title',
            'title.regex' => 'Special Character Not Allowed',
            'description.required'       => 'Please Enter Description',
            'schedule_date_time.required'        => 'Please Select Schedule Date & Time',
        ];
    }
}
