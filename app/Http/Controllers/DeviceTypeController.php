<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeviceTypeRequest;
use App\Http\Requests\UpdateDeviceTypeRequest;
use App\Models\DeviceType;

class DeviceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deviceTypes = DeviceType::orderBy('name')->paginate(10);

        return view('pages.register.device_types.index', [
            'lines' => $deviceTypes,
            'header' => ['name' => 'Name'],
            'actions' => ['edit' => 'device_types.edit', 'delete' => 'device_types.destroy'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.register.device_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeviceTypeRequest $request)
    {
        $deviceType = DeviceType::create($request->validated());

        return redirect()->route('device_types.index')
            ->with('success', 'Device Type created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceType $deviceType)
    {
        return view('pages.register.device_types.edit', ['type' => $deviceType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeviceTypeRequest $request, DeviceType $deviceType)
    {
        $deviceType->update($request->validated());

        return redirect()->route('device_types.index')
            ->with('success', 'Device Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceType $deviceType)
    {
        $deviceType->delete();

        return redirect()->route('device_types.index')->with('success', 'Device Type deleted successfully.');
    }
}
