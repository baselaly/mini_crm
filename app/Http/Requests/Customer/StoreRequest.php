<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:200',
            'email' => 'required|email|max:200|unique:customers,email',
            'phone' => 'required|numeric|min:1|digits_between:1,20|unique:customers,phone',
            'source' => 'required|max:200',
        ];

        // if its admin check for employee id
        if (auth()->user()->hasRole('admin')) {
            $rules['employee_id'] = 'required|exists:users,id';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'employee_id.required' => 'employee field is required',
            'employee_id.exists' => 'employee field is invalid'
        ];
    }
}
