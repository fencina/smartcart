<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'file_number' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role_id' => 'required|integer|min:1|exists:roles,id',
        ];

        if ($this->method() == 'PUT' OR $this->method() == 'PATCH' ) {
            $rules['file_number'] = 'required|string|unique:users,id,'.$this->input('id');
            $rules['email'] = 'required|email|unique:users,id,'.$this->input('id');
            $rules['password'] = '';
        }

        return $rules;
    }
}
