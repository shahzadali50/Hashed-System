<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LeadRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $leadId = $this->route('id') ?? $this->route('lead');

        return [
            'name'        => 'required|string|max:255',
            'email'       => [
                'required',
                'email',
                Rule::unique('leads', 'email')->ignore($leadId),
            ],
            'phone'       => 'required|string|max:20',
            'status'      => 'required|in:new,contacted,closed',
            'assigned_to' => 'required|exists:users,id',
            'notes'       => 'required|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required'        => 'The lead name is required.',
            'name.max'             => 'The lead name cannot exceed 255 characters.',
            'email.required'       => 'The email address is required.',
            'email.email'          => 'Please provide a valid email address.',
            'email.unique'         => 'This email address is already taken.',
            'phone.required'       => 'The phone number is required.',
            'phone.max'            => 'The phone number cannot exceed 20 characters.',
            'status.required'      => 'The status is required.',
            'status.in'            => 'The status must be one of: new, contacted, closed.',
            'assigned_to.exists'   => 'The selected user does not exist.',
            'notes.required'       => 'The notes field is required.',
        ];
    }

    /**
     * Force JSON validation error responses.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors'  => $validator->errors()
            ], 422)
        );
    }
}
