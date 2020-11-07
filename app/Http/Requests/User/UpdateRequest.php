<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $userId = $this->route('user');

        $rules = [
            'name' => 'required|max:200',
            'phone' => 'required|numeric|min:1|digits_between:1,20|unique:users,phone,' . $userId,
            'email' => 'required|email|max:200|unique:users,email,' . $userId,
            'role' => 'required|exists:roles,name'
        ];

        request('password') ? $rules['password'] = 'min:8|confirmed' : '';

        return $rules;
    }
}
