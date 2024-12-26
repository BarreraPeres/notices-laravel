<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreNoticesAndNotificationsRequest extends FormRequest
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
            "title" => ["required", "string"],
            "user_type" => ["required", "string"],
            "description" => ["required", "string"],
            //          "author" => ["required", "string"],
            "procedure" => ["required", "string"],
            "brief_description" => ["required", "string"],
            "generate_pop_up" => ["nullable", "boolean"],
            "pop_up_expiration" => ["nullable", "date"],
        ];
    }
    public function faliedValidation(Validator $val): void
    {
        throw new HttpResponseException(
            Response()->json(["errors" => $val->errors()], 400)
        );
    }
}
