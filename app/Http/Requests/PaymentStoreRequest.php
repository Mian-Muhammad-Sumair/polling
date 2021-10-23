<?php

namespace App\Http\Requests;

use App\Models\PollKey;
use App\Models\SubscriptionPlan;
use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'payment_mode' => 'nullable',
            'plan' => 'required',


        ];
    }
}
