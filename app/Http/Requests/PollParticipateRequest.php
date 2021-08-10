<?php

namespace App\Http\Requests;

use App\Models\Poll;
use Illuminate\Foundation\Http\FormRequest;

class PollParticipateRequest extends FormRequest
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
//            'polling_key' => 'required|exists:polls,key',
            'polling_key' => [
                'required',
                'exists:polls,key',
                function ($attribute, $value, $fail) {
            $poll=Poll::where('key',$value)->first();
                    if ($poll['status'] != 'Publish Poll') {
                        $fail('This Poll is not active.');
                    }elseif(now()->format('Y-m-d') >= $poll['end_date']){
                        $fail('This Poll is Expired.');
                    }
                },
            ],
        ];
    }
}
