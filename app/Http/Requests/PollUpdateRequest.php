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
            'identifier_question.*'=> 'required',
            'visibility' => 'required',
            'option_type' => 'nullable|array',
            'status'=> 'required|in:Lock Poll,Published',
            'key' => 'required|array',
            "key.*" => [
                'required',
                function ($attribute, $value, $fail) {
                    $id=explode('.',$attribute);
                    $id=PollKey::where('id',$id[1])->first();
                    $key = PollKey::where('key', $value);
                    if($id){
                        $key=$key->where('poll_id', '!=', $id->poll_id);
                    }
                    $key=$key->first();
                    if ($key) {
                        $fail('Please Enter a unique key.');
                    }

                },
            ],
        ];
    }
}
