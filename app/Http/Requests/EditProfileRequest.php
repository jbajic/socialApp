<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
    *   If you don't write return true in authorize the page will return forbidden!!
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
            'first_name' => 'alpha|max:50',
            'last_name' => 'alpha|max:50',
            'location' => 'max:50',
        ];
    }
}
