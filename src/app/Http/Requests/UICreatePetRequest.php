<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UICreatePetRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'profile_image' => 'sometimes|image|max:1024',
            'description' => 'sometimes|max:255',
            'birthdate' => 'required|date',
            'race' => 'required',
            'gender' => 'required',
            'id_user' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id_user.required' => 'Please send id_user'
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
