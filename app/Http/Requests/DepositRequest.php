<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DepositRequest extends FormRequest
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
        $types = [
            'deposit', 
            'withdraw'
        ];

        return [
            'amount' => ['required', 'numeric', 'min:0'],
            'type' => [
                'required',
                'string',
                Rule::in($types)
            ],
        ];
    }
}
