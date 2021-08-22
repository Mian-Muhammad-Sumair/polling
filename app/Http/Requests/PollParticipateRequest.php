<?php

namespace App\Http\Requests;

use App\Models\Poll;
use App\Models\PollIdentifierAnswer;
use App\Models\PollKey;
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
            'polling_key' => [
                'required',
                'exists:poll_keys,key',
                function ($attribute, $value, $fail) {
            $pollKey=PollKey::where('key',$value)->with('Poll')->first();
                    $poll= $pollKey['Poll'];
                    $optionType=$poll['option_type'];
                    if ($poll['status'] != 'Publish Poll') {
                        $fail('This Poll is not active.');
                    }elseif(now()->format('Y-m-d') >= $poll['end_date']){
                        $fail('This Poll is Expired.');
                    }elseif($poll['edit_by']!=0){
                        $fail('This Poll is banned by admin.');
                    }
                    elseif(isset($optionType) && $optionType!=''){
                        if (in_array("login_to_vote", $optionType)) {
                            //this validation is not working because is this request we cannot trace if the user is login or not
//                        $fail('You must have to login first to participate in this poll.');
                        }
                        if(!in_array("allow_multiple_votes", $optionType)) {
                            $vote=PollIdentifierAnswer::where('user_id',request()->ip())->IdentifyUser($poll['id'])->first();
                            if(!empty($vote)){
                                $fail('You already vote on this poll ');
                            }
                        }
                    }
                },
            ],
        ];
    }
}
