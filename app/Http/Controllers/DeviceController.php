<?php

namespace App\Http\Controllers;

use App\DTOs\DeviceDTO;
use App\Models\Device;
use App\Services\DeviceService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DeviceController extends Controller
{
    private DeviceService $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    public function index() 
    {
        return Device::all();
    }

    public function show($id) 
    {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404);
        }

        return response()->json($device);
                
    }

    public function store(Request $request) 
    {
        try {
            $deviceDTO = new DeviceDTO($request->all());
            $newCreatedDevice = $this->deviceService->create($deviceDTO);

            return response()->json($newCreatedDevice, 201);

        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()], 442);
        }
    }

    public function update(Request $request, Device $device) 
    {
        $device->update($request->all());
        return response()->json($device, 200);
    }

    public function destroy($id) 
    {
        $device = Device::find($id);
        
        if (!$device) {
            return response()->json(['message' => 'Device not found'], 404);
        }

        $device->delete();
        return response()->json(null, 204);
    }
}
