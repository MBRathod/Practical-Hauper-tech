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
            'title'       =>  'required',
            'description'      =>  'required',
            'schedule_date_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'       => 'Please Enter Title',
            'description.required'       => 'Please Enter Description',
            'schedule_date_time.required'        => 'Please Select Schedule Date & Time',
        ];
    }
}
