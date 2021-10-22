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
            'question' => 'required',
            'poll_option' => 'required|array',
            'poll_option.*'=> 'required',
            'visibility' => 'required',
            'option_type' => 'nullable|array',
            'question_video' => 'max:20480',
            'status'=> 'required|in:Lock Poll,Published',
            'key' => 'required_if:status,Publish Poll|array',
            'key.*.key' => 'unique:poll_keys,key',
            'key.*.required' => 'nullable',
            'key_type' => 'nullable|numeric',
            'identifier_question' => 'required|array',
            'identifier_question.*.question'=> 'required',
            'identifier_question.*.required'=> 'nullable',

        ];
    }

    public function messages()
    {
        return [
            'required' => 'This field is required.',
        ];
    }
}
