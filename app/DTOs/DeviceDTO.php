<?php

namespace App\DTOs;

class DeviceDTO implements DTO 
{
    private $name;
    private $powerRating;
    private $usageHours;
    private $createdAt;
    private $updatedAt;

    public function __construct($data) 
    {
        $this->name = $data['name'] ?? '';
        $this->powerRating = (int) ($data['powerRating'] ?? 0);
        $this->usageHours = (int) ($data['usageHours'] ?? 0);
        $this->createdAt = $data['createdAt'] ?? '';
        $this->updatedAt = $data['createdAt'] ?? '';
    }

    public function rules(): array 
    {
        return [
            'name' => 'required|string|max:255',
            'powerRating' => 'required|numeric',
            'usageHours' => 'required|numeric',
        ];
    }

    public function toArray(): array 
    {
        return [
            'name' => $this->name,
            'powerRating' => $this->powerRating,
            'usageHours' => $this->usageHours,
        ];
    }

    public function toJsonArray(): array 
    {
        return [
            'deviceName' => $this->name,
            'powerRating' => $this->powerRating,
            'usageHours' => $this->usageHours,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }

    public function __toString(): string
    {
        return sprintf(
            'Device Name: %s, Power Rating: %d, Usage Hours: %d',
            $this->name,
            $this->powerRating,
            $this->usageHours
        );
    }

    // Getter and Setter for name
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    // Getter and Setter for powerRating
    public function getPowerRating(): int
    {
        return $this->powerRating;
    }

    public function setPowerRating(int $powerRating): void
    {
        $this->powerRating = $powerRating;
    }

    // Getter and Setter for usageHours
    public function getUsageHours(): int
    {
        return $this->usageHours;
    }

    public function setUsageHours(int $usageHours): void
    {
        $this->usageHours = $usageHours;
    }

    // Getter and Setter for createdAt
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    // Getter and Setter for updatedAt
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
