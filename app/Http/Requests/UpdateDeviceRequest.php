<?php

namespace App\Http\Requests;

use App\Enums\DeviceTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDeviceRequest extends StoreDeviceRequest
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
            'serial_number' => ['nullable', 'string', 'max:50', Rule::unique('devices', 'serial_number')->ignore($this->device)],
            'service_tag' => ['nullable', 'string', 'max:30', Rule::unique('devices', 'service_tag')->ignore($this->device)],
            'description' => ['nullable', 'string'],
        ];
    }
}
