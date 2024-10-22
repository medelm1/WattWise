<?php

namespace App\DTOs;

class ApplianceDTO implements DTO
{
    private $id;
    private $name;
    private $powerRating;
    private $usageHours;
    private $units;
    private $createdAt;
    private $updatedAt;

    public function __construct($data) 
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? '';
        $this->powerRating = (int) ($data['powerRating'] ?? 0);
        $this->usageHours = (float) ($data['usageHours'] ?? 0);
        $this->units = (int) ($data['units'] ?? 1);
        $this->createdAt = $data['createdAt'] ?? '';
        $this->updatedAt = $data['createdAt'] ?? '';
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'powerRating' => 'required|numeric',
            'usageHours' => 'required|numeric',
            'units' => 'sometimes|numeric',
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'powerRating' => $this->powerRating,
            'usageHours' => $this->usageHours,
            'units' => $this->units,
        ];
    }

    public function toJsonArray(): array
    {
        $energyCategory = '';

        if ($this->powerRating < 200) {
            $energyCategory = 'Low';
        } elseif ($this->powerRating >= 200 && $this->powerRating <= 799) {
            $energyCategory = 'Medium';
        } elseif ($this->powerRating >= 800 && $this->powerRating <= 1400) {
            $energyCategory = 'High';
        } else {
            $energyCategory = 'Very High';
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'powerRating' => $this->powerRating,
            'usageHours' => $this->usageHours,
            'units' => $this->units,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'energyCategory' => $energyCategory,
        ];
    }

    public function __toString(): string
    {
        return sprintf(
            'Device Name: %s, Power Rating: %d, Usage Hours: %d, Units: %d',
            $this->name,
            $this->powerRating,
            $this->usageHours,
            $this->units
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

    // Getter and Setter for units
    public function getUnits(): int
    {
        return $this->units;
    }

    public function setUnits(int $units): void
    {
        $this->units = $units;
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