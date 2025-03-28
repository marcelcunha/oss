<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Device;
use App\Models\DeviceType;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Device::query()
            ->with(['client', 'type', 'brand'])
            ->paginate(10);

        return view('pages.register.devices.index', [
            'rows' => $devices,
            'columns' => [
                'client.name' => 'Proprietário',
                'type.name' => 'Tipo',
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::orderBy('name')->pluck('name', 'id');
        $types = DeviceType::orderBy('name')->pluck('name', 'id');
        $brands = Brand::orderBy('name')->pluck('name', 'id');

        return view('pages.register.devices.create', compact('clients', 'types', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeviceRequest $request)
    {

        Device::create($request->validated());

        return redirect()->route('devices.index')
            ->with('success', 'Equipamento cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Device $device)
    {
        return view('pages.register.devices.show', compact('device'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Device $device)
    {
        $clients = Client::orderBy('name')->pluck('name', 'id');
        $types = DeviceType::orderBy('name')->pluck('name', 'id');
        $brands = Brand::orderBy('name')->pluck('name', 'id');

        return view('pages.register.devices.edit', compact('device', 'clients', 'types', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceRequest $request, Device $device)
    {
        $device->update($request->validated());

        return redirect()->route('devices.index')
            ->with('success', 'Equipamento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.index')
            ->with('success', 'Equipamento excluído com sucesso!');
    }
}
