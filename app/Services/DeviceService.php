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

    public function getAllDevices(): \Illuminate\Support\Collection
    {
        $devices = Device::all();

        return $devices->map(function ($device) {
            $deviceDTO = new DeviceDTO($device);
            return $deviceDTO->toJsonArray();
        });
    }

    public function getDeviceById($id): ?Device
    {
        return Device::find($id);
    }

    public function createDevice(DeviceDTO $deviceDTO): DeviceDTO {

        $validatedData = $this->validateData->execute($deviceDTO);

        $newDevice = Device::create([
            'name' => $validatedData['name'],
            'power_rating' => $validatedData['powerRating'],
            'usage_hours' => $validatedData['usageHours'],
        ]);

        $newDeviceDTO = new DeviceDTO($newDevice);

        return $newDeviceDTO;
    }

    public function updateDevice($id, DeviceDTO $deviceDTO): ?Device
    {
        // $device = Device::find($id);
        // if (!$device) {
        //     return null;
        // }
        
        // $validatedData = $this->validateData->execute($deviceDTO);
        // $device->update($validatedData->safe()->all());
        
        // return $device;
        return null;
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
