<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|string|max:125',
            'last_name' => 'required|string|max:125',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|regex:/^[0-9]{11}$/',
            'type' => 'required',
            'uname' => 'required|string|max:50',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

}
