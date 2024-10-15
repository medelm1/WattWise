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

    public function create(DeviceDTO $deviceDTO) : Device {
        $validatedData = $this->validateData->exceute($deviceDTO);

        $device = Device::create($deviceDTO->toArray());

        return $device;
    }

}