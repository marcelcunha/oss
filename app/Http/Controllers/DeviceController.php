<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;
use App\Models\Device;
use App\Services\DeviceService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DeviceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(DeviceService $service): View
    {
        return view('pages.register.devices.create', $service->create());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device): RedirectResponse
    {
        $device->delete();

        return redirect()->route('devices.index')
            ->with('success', 'Equipamento excluído com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device, DeviceService $service): View
    {
        return view('pages.register.devices.edit', $service->edit($device));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $devices = Device::query()
            ->with(['client', 'brand'])
            ->paginate(10);

        return view('pages.register.devices.index', [
            'rows' => $devices,
            'columns' => [
                'client.name' => 'Proprietário',
                'type' => ['label' => 'Tipo', 'format' => 'enum'],
                'brand.name' => 'Marca',
                'model' => 'Modelo',
            ],
            'actions' => [
                'show' => 'devices.show',
                'edit' => 'devices.edit',
                'delete' => 'devices.destroy',
            ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device): View
    {
        return view('pages.register.devices.show', compact('device'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeviceRequest $request): RedirectResponse
    {

        Device::create($request->validated());

        return redirect()->route('devices.index')
            ->with('success', 'Equipamento cadastrado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceRequest $request, Device $device): RedirectResponse
    {
        $device->update($request->validated());

        return redirect()->route('devices.index')
            ->with('success', 'Equipamento atualizado com sucesso!');
    }
}
