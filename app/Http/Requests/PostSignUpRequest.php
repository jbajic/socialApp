<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostSignUpRequest extends Request
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
     *  php artisan make:request name
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:20|unique:users|alpha_dash',
            'password' => 'required|min:6',
        ];
    }
}
