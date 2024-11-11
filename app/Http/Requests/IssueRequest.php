<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IssueRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'reporter' => 'required|string|max:255',
            'tester' => 'required|string|max:255',
            'executor' => 'required|string|max:255',
            'status' => 'required|integer|in:1,2,3,4',
            'type' => 'required|integer|in:1,2',
        ];
    }
}
