<?php

namespace App\Http\Requests;

use App\Enums\DeviceTypeEnum;
use App\Models\Device;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBudgetRequest extends FormRequest
{
    private ?Device $device = null;

    public function attributes(): array
    {
        return [
            'client_id' => 'cliente',
            'device_id' => 'equipamento',
            'description' => 'relatos',
            'configuration.os' => 'sistema operacional',
            'configuration.cpu.brand_id' => 'marca do processador',
            'configuration.cpu.model' => 'modelo do processador',
            'configuration.mobo.brand_id' => 'marca da placa mãe',
            'configuration.mobo.model' => 'modelo da placa mãe',
            'configuration.memory.*.brand_id' => 'marca da memória',
            'configuration.memory.*.model' => 'modelo da memória',
            'configuration.memory.*.size' => 'tamanho da memória',
            'configuration.storage.*.brand_id' => 'marca do armazenamento',
            'configuration.storage.*.model' => 'modelo do armazenamento',
            'configuration.storage.*.size' => 'tamanho do armazenamento',
            'configuration.gpu.brand_id' => 'marca da placa de vídeo',
            'configuration.gpu.model' => 'modelo da placa de vídeo',
            'configuration.gpu.ram' => 'memória da placa de vídeo',
            'configuration.power_supply.brand_id' => 'marca da fonte',
            'configuration.power_supply.model' => 'modelo da fonte',
            'configuration.power_supply.wattage' => 'potência da fonte',
        ];
    }

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
            'date' => ['required', 'date', 'before_or_equal:today'],
            'client_id' => ['required', 'exists:clients,id'],
            'device_id' => ['required', 'exists:devices,id'],
            'description' => ['required', 'string'],
            'configuration.os' => [Rule::requiredIf($this->validateDeviceTypeForDesktopAndLaptop())],
            'configuration.cpu.brand_id' => [Rule::requiredIf($this->validateDeviceTypeForDesktopAndLaptop()), 'exists:brands,id'],
            'configuration.cpu.model' => [Rule::requiredIf($this->validateDeviceTypeForDesktopAndLaptop())],
            'configuration.mobo.brand_id' => [Rule::requiredIf($this->validateDeviceTypeForDesktop()), 'exists:brands,id'],
            'configuration.mobo.model' => [Rule::requiredIf($this->validateDeviceTypeForDesktop())],
            'configuration.memory.*.brand_id' => [Rule::requiredIf($this->validateDeviceTypeForDesktop()),  'exists:brands,id'],
            'configuration.memory.*.model' => [Rule::requiredIf($this->validateDeviceTypeForDesktop())],
            'configuration.memory.*.size' => [Rule::requiredIf($this->validateDeviceTypeForDesktop())],
            'configuration.storage.*.brand_id' => [Rule::requiredIf($this->validateDeviceTypeForDesktopAndLaptop()),  'exists:brands,id'],
            'configuration.storage.*.model' => [Rule::requiredIf($this->validateDeviceTypeForDesktopAndLaptop())],
            'configuration.storage.*.size' => [Rule::requiredIf($this->validateDeviceTypeForDesktopAndLaptop())],
            'configuration.gpu.brand_id' => ['nullable', 'exists:brands,id'],
            'configuration.gpu.model' => ['required_with:configuration.gpu.brand_id', 'nullable'],
            'configuration.gpu.ram' => ['required_with:configuration.gpu.brand_id',  'nullable'],
            'configuration.power_supply.brand_id' => [Rule::requiredIf($this->validateDeviceTypeForDesktop()), 'nullable', 'exists:brands,id'],
            'configuration.power_supply.model' => [Rule::requiredIf($this->validateDeviceTypeForDesktop()),  'nullable'],
            'configuration.power_supply.wattage' => [Rule::requiredIf($this->validateDeviceTypeForDesktop()),  'nullable'],
        ];
    }

    private function getDevice(): ?Device
    {
        if ($this->device === null) {
            $this->device = Device::find($this->device_id);
        }

        return $this->device;
    }

    private function validateDeviceTypeForDesktop(): Closure
    {
        return function () {
            $device = $this->getDevice();

            if ($device === null) {
                return true;
            }

            return $device->type == DeviceTypeEnum::DESKTOP;
        };
    }

    private function validateDeviceTypeForDesktopAndLaptop(): Closure
    {
        return function () {
            $device = $this->getDevice();

            if ($device === null) {
                return true;
            }

            return $device->type == DeviceTypeEnum::DESKTOP || $device->type == DeviceTypeEnum::LAPTOP;
        };
    }
}
