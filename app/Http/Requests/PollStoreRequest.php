<?php

namespace App\Http\Requests;

use App\Models\PollKey;
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
            'poll_option.*' => 'required',
            'visibility' => 'required',
            'option_type' => 'nullable|array',
            'question_video' => 'max:20480',
            'status' => 'required|in:Lock Poll,Published',
            'key' => ['bail','required_if:status,Published', 'array',
                function ($attribute, $value, $fail) {
                    foreach ($value as $index=>$val) {
                        if (isset($val['required']) && $val['required']) {
                            $keyCheck=PollKey::where('key',$val['key'])->exists();
                            if($keyCheck){
                                $fail("This key ({$val['key']}) already assign to another poll.");
                            }else{
                                $matchKeysCount=collect($value)->where('required',1)->where('key',$val['key'])->count();
                                if($matchKeysCount>1){
                                    $fail("Duplication key error ({$val['key']})");
                                }
                            }
                        }else{
                            $fail("Please enter poll key first");
                        }
                    }

                }],
            'key.*.key' => 'nullable',
            'key.*.required' => 'nullable',
            'key_type' => 'nullable|numeric',
            'identifier_question' => 'required|array',
            'identifier_question.*.question' => 'required',
            'identifier_question.*.required' => 'nullable',

        ];
    }

    public function messages()
    {
        return [
            'required' => 'This field is required.',
        ];
    }
}
