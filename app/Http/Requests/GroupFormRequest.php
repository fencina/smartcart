<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupFormRequest extends FormRequest
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
            'name' => 'required|string|max:15',
            'members.*' => 'distinct|not_in:'. $this->user()->id .'|exists:clients,id'
        ];

        if ($this->method() == 'PUT' OR $this->method() == 'PATCH') {
            $rules['name'] = 'string|max:15';
            $rules['members'] = 'required';
            $rules['members.*'] = 'distinct|exists:clients,id';
        }

        return $rules;
    }
}
