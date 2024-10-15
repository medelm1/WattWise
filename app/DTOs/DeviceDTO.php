<?php

namespace App\DTOs;

class DeviceDTO implements DTO {

    private $name;
    private $powerRating;
    private $usageHours;

    public function __construct($data) {
        $this->name = $data['name'] ?? '';
        $this->powerRating = $data['power_rating'] ?? '';
        $this->usageHours = $data['usage_hours'] ?? '';
    }

    public function rules(): array {
        return [
            'name' => 'required|string|max:255',
            'power_rating' => 'required|numeric',
            'usage_hours' => 'required|numeric',
        ];
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'power_rating' => $this->powerRating,
            'usage_hours' => $this->usageHours,
        ];
    }

}