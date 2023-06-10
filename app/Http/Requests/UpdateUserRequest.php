<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string',
            'username' => 'required|alpha_dash|unique:users,username,' . $this->route('user')->id,
            'role' => 'required'
        ];

        if ($this->filled('password')) {
            $rules['password'] = 'required|alpha_dash|min:5|confirmed';
        }

        return $rules;
    }
}
