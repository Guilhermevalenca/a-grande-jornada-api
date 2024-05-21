<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'questions' => ['required', 'array'],
            'questions.*.title' => ['required', 'string'],
            'questions.*.options' => ['required', 'array'],
            'questions.*.options.*.title' => ['required', 'string'],
            'questions.*.options.*.isOpen' => ['required', 'boolean'],
            'questions.*.options.*.correctAlternative' => ['required', 'boolean']
        ];
    }
}
