<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'info' => 'required',
            'category' => 'required',
            'visibility' => 'required',
            'question' => 'required',
            'option' => 'required|array',
            'Poll_category' => 'required',
            'key' => 'required|unique:polls,key',
        ];
    }
}
