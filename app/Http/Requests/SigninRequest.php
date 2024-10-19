<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SigninRequest extends FormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  */
    // public function authorize(): bool
    // {
    //     return true;
    // }

    // /**
    //  * Get the validation rules that apply to the request.
    //  *
    //  * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    //  */
    public function rules(): array
    {
        return [
            "email" => 'required|email|string|max:255',
            "password" => 'required|min:6|string|max:255'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException((response()->json(
            [
                'errors' => array_values($validator->errors()->getMessages())[0][0],
                // 'status' => 'error'
                // 'errors' => $validator->errors(),
                // 'status' => 'error'
            ]
        )));
    }
}
