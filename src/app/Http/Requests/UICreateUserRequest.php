<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class UICreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'profile_image' => 'sometimes|image|size:4096',
            'username' => 'required|unique:users,username',
            'gender' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'messages' => 'Validation Error',
            'data' => $validator->errors()
        ], 422));
    }
}
