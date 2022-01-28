<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdateTodoRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:128',
            'status' => 'required|boolean',
            'tuid' => 'required|exists:todolist,id',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator): JsonResponse
    {
        throw (new ValidationException($validator, $this->invalidResponse($validator->errors()->all())));
    }
}
