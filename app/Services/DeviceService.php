<?php

namespace App\Services;

use App\Actions\ValidateData;
use App\DTOs\DeviceDTO;
use App\Models\Device;

class DeviceService {

    private ValidateData $validateData;

    public function __construct(ValidateData $validateData) {
        $this->validateData = $validateData;
    }

    public function createDevice(DeviceDTO $deviceDTO): Device {
        $validatedData = $this->validateData->execute($deviceDTO);
        return Device::create($validatedData->safe()->all());
    }

    public function getAllDevices(): \Illuminate\Database\Eloquent\Collection
    {
        return Device::all();
    }

    public function getDeviceById($id): ?Device
    {
        return Device::find($id);
    }

    public function updateDevice($id, DeviceDTO $deviceDTO): ?Device
    {
        $device = Device::find($id);
        if (!$device) {
            return null;
        }
        
        $validatedData = $this->validateData->exceute($deviceDTO);
        $device->update($validatedData->safe()->all());
        
        return $device;
    }

    public function deleteDevice($id): bool
    {
        $device = Device::find($id);
        if (!$device) {
            return false;
        }

        $device->delete();
        return true; 
    }
}
