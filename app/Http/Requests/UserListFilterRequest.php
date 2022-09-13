<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UserListFilterRequest extends FormRequest
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
            'sort_by_first_name' => 'in:asc,desc',
            'sort_by_last_name' => 'in:asc,desc',
            'sort_by_group_count' => 'in:asc,desc',
        ];
    }

    public function messages()
    {
        return [
          'sort_by_first_name.in' => "Sort by first name must be asc or desc",
          'sort_by_last_name.in' => "Sort by last name must be asc or desc",
          'sort_by_group_count.in' => "Sort by group count must be asc or desc",
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
