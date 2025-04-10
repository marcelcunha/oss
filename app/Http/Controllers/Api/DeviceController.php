<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceResource;
use App\Http\Resources\DeviceThinResource;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DeviceController extends Controller
{
    public function device(Device $device): JsonResource
    {
        return new DeviceResource($device);
    }

    public function devices(Request $request): ResourceCollection
    {
        return DeviceThinResource::collection(\App\Services\DeviceService::devices($request->integer('client_id') ));
    }
}
