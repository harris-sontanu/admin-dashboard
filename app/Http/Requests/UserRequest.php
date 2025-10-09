<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array|min:1',
        ];

        switch ($this->method()) {
            case 'PUT':
            case 'PATCH':
                $rules['email'] = [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore(Auth::user()->id),
                ];
                $rules = Arr::except($rules, ['password', 'roles']);
                break;
        }

        return $rules;
    }
}
