<?php

namespace App\Http\Requests;

class UpdateBudgetRequest extends StoreBudgetRequest
{
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
        ];
    }
}
