<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255', 'min:2'],
            'last_name' => ['required', 'string', 'max:255', 'min:4'],
            'personal_number' => ['required', 'string', 'max:11', 'unique:users,personal_number'],
            'username' => ['required', 'string', 'max:255', 'min:4', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ];
    }


    /**
     * Get the error messages for the defined validation rules.*
     * @return array
     */
    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'errors' => $validator->errors(),
    //         'status' => true
    //     ], 422));
    // }


    public function attributes(): array
    {
        return [
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'personal_number' => 'Personal Number',
            'username' => 'User name',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }
}
