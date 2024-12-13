<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
        return [
            "name" => ["string", "required"],
            "email" => ["required", "email", "unique:users"],
            "password" => ["required", "confirmed"]
        ];
    }

    /**
     * return message in json for validation errors with code 400 (bad request)
     * @param Validator $val
     * @throws HttpResponseException
     */

    public function failedValidation(Validator $val): void
    {
        throw new HttpResponseException(
            Response()->json(["errors" => $val->errors()], 400)
        );
    }
}
