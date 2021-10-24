<?php

namespace App\Http\Requests;

use App\Models\PollKey;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionPlanUpdateRequest extends FormRequest
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
            'plan_type' => 'required',
            'plan_value' => 'required',
            'info' => 'required',
            'allow_poll' => 'required',
            'amount' => 'required',

        ];
    }
}
