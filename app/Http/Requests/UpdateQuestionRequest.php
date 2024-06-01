<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
            'id' => ['int', 'required', 'exists:App\Models\Question,id'],
            'title' => ['string', 'required'],
            'form_id' => ['int', 'required', 'exists:App\Models\Form,id'],
            'options' => ['array', 'required'],
            'options.*.id' => ['nullable', 'int', 'exists:App\Models\Option,id'],
            'options.*.title' => ['string', 'nullable'],
            'options.*.isOpen' => ['required', 'boolean'],
            'options.*.correctAlternative' => ['required', 'boolean']
        ];
    }
}
