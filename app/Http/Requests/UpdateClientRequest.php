<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'name' => ['required', 'max:60'],
            'phone' => ['required', 'max:16', 'min:14'],
            'address' => ['nullable', 'max:60'],
            'num' => ['required_with:address', 'prohibited_if:address,null', 'nullable', 'numeric'],
            'complement' => ['nullable', 'max:60', 'prohibited_if:address,null',],
        ];
    }
}
