<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateUserRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'description' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        foreach ($validator->messages()->getMessages() as $key => $message) {
            $messages[] = $message[0];
        }
        $response = response()->json([
            'status' => 'ERROR',
            'message' => $messages,
        ], 422);
        throw new ValidationException($validator, $response);
    }
}
