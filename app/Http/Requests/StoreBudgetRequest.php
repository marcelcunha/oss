<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBudgetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return ['items.required' => 'É necessário adicionar pelo menos um item ao orçamento.'];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'budget_date' => ['required', 'date', 'before_or_equal:'.today()],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array'],
            'checkin_id' => ['exists:checkins,id'],
        ];
    }
}
