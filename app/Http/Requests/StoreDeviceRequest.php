<?php

namespace App\Http\Requests;

use App\Enums\DeviceTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDeviceRequest extends FormRequest
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
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'type' => ['required', Rule::enum(DeviceTypeEnum::class)],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'model' => ['nullable', 'string', 'max:50'],
            'serial_number' => ['nullable', 'string', 'max:50', 'unique:devices,serial_number'],
            'service_tag' => ['nullable', 'string', 'max:30', 'unique:devices,service_tag'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function attributes() :array
    {
        return [
            'client_id' => 'cliente',
            'brand_id' => 'marca',
            'model' => 'modelo',
            'serial_number' => 'número de série',
            'service_tag' => 'service tag',
            'description' => 'descrição',
        ];
    }
}
