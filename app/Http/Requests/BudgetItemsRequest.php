<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetItemsRequest extends FormRequest
{
    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function attributes() : array
    {
        return [
            'items' => 'budget items',
            'items.*.description' => 'descrição',
            'items.*.price' => 'preço',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $items = $this->input('items', []);

        foreach ($items as $index => $item) {
            if (isset($item['price'])) {
                $items[$index]['price'] = preg_replace('/\D/', '', $item['price']);
            }
        }

        $this->merge(['items' => $items]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'items' => ['required', 'array'],
            'items.*' => ['distinct', 'array'],
            'items.*.description' => ['required', 'string', 'distinct'],
            'items.*.price' => ['required', 'numeric', 'gt:0'],
        ];
    }
}
