<?php

namespace App\Http\Responses;

use App\Http\Traits\ValidatesCollectionType;
use App\Models\Device;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class DeviceJsonResponse extends JsonResponse
{
    use ValidatesCollectionType;

    public function __construct($payload, int $status = 200)
    {
        if ($payload instanceof Collection) {
            if (!$this->isCollectionOfType($payload, Device::class)) {
                throw new InvalidArgumentException('The collection must contain on Device instances');
            }

            $data = $payload->map(fn(Device $device) => $this->toArray($device))->all();

        } else {
            $data = $this->toArray($payload);
        }

        parent::__construct($data, $status);
    }

    protected function toArray(Device $device): array
    {
        return [
            "id" => $device->id,
            "name" => $device->name,
            "power_rating" => $device->power_rating,
            "usage_hours" => $device->usage_hours,
        ];
    }
}
