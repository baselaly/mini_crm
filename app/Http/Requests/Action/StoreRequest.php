<?php

namespace App\Http\Requests\Action;

use App\Http\Traits\ApiValidationError;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    use ApiValidationError;

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
            'type' => 'required|in:call,visit,follow up',
            'description' => 'required|max:1000'
        ];

        request('record') ? $rules['record'] = 'file|mimes:webm|max:10000' : '';

        return $rules;
    }
}
