<?php

namespace App\Http\Requests;

use App\Models\PollKey;
use Illuminate\Foundation\Http\FormRequest;

class PollUpdateRequest extends FormRequest
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
            'end_date' => 'required|date|after:start_date',
            'info' => 'required',
            'category' => 'required',
            'question' => 'required',
            'poll_option' => 'required|array',
            'poll_option.*'=> 'required',
            'identifier_question' => 'required|array',
            'identifier_question.*.question' => 'required',
            'identifier_question.*.required' => 'nullable',
            'visibility' => 'required',
            'option_type' => 'nullable|array',
            'status'=> 'required|in:Lock Poll,Published',
            'key' => ['bail','required_if:status,Published', 'array',
                function ($attribute, $value, $fail) {
                    foreach ($value as $index=>$val) {
                        if (isset($val['required']) && $val['required']) {
                            $keyCheck=PollKey::where('key',$val['key'])->where('poll_id','!=',$this->poll_id)->exists();
                            $matchKeysCount=collect($value)->where('required',1)->where('key',$val['key'])->count();
                            if($keyCheck || $matchKeysCount>1) {
                                $fail("Duplication key error ({$val['key']})");
                                $fail("This key ({$val['key']}) already assign to another poll.");
                            }
                        }else{
                            $fail("Please enter poll key first");
                        }
                    }

                }],
            'key.*.key' => 'nullable',
            'key.*.required' => 'nullable',
        ];
    }
}
