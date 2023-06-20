<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;

class RegisterRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required|string',
            'phone' => ['required', 'regex:/^(?:\+?84|0)(?:\d){9,10}$/'],
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:6|max:64',
        ];
    }
}
