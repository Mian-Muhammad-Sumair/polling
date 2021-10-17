<?php

namespace App\Http\Requests;

use App\Models\Poll;
use App\Models\PollKey;
use Illuminate\Foundation\Http\FormRequest;

class PollIdentifierQuestionStoreRequest extends FormRequest
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
            "answer" => "required|array",
            "answer.*" => [
                'required',
                function ($attribute, $value, $fail) {
                    if (isset($value['question']) && $value['question'] == 1 && ($value['answer'] == ''||$value['question'] == '')) {
                        $fail('This answer is required.');
                    }
                },
            ],

        ];
    }
}
