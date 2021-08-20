<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserPasswordChangeRequest extends FormRequest
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
            'old_password' => ['required', function ($attribute, $value, $fail) {
            $password=User::where('id',auth()->id())->select('password')->first();
            if(!password_verify($value,$password->password)){
                    $fail('Please enter correct password.');
                }
            }],
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ];
    }
}
