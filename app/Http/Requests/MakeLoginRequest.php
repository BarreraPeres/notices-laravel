<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

/**
 * Handle Login Request
 * @property-read string $email
 * @property-read string $password
 */
class MakeLoginRequest extends FormRequest
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
            "email" => ["required", "email"],
            "password" => ["required", "min:6"]
        ];
    }

    /**
     *  Return error in json with message bad request
     *  @param Validator $val
     *  @throws HttpResponseException
     */

    public function failedValidation(Validator $val): void
    {
        //abort_unless(!$val->errors(), 400);
        throw new HttpResponseException(
            response()->json(["errors" => $val->errors()], 400)
        );
    }
}
