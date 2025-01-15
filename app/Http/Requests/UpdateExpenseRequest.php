<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'description' => ['required'],
                'value' => ['required'],
                'issuedAt' => ['required'],
                'user' => ['required'],
                'category' => ['required'],
            ];
        } else {
            return [
                'description' => ['sometimes', 'required'],
                'value' => ['sometimes', 'required'],
                'issuedAt' => ['sometimes', 'required'],
                'user' => ['sometimes', 'required'],
                'category' => ['sometimes', 'required'],
            ];
        }
    }
}
