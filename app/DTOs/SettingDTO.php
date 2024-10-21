<?php

namespace App\DTOs;

class SettingDTO implements DTO
{
    private $id;
    private $key;
    private $value;
    private $description;

    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->key = $data['key'] ?? '';
        $this->value = $data['value'] ?? '';
        $this->description = $data['description'] ?? '';
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function toArray(): array
    {
        return [
            "key" => $this->key,
            "value" => $this->value,
            "description" => $this->description
        ];
    }

    public function toJsonArray(): array
    {
        return [
            "id" => $this->id,
            "key" => $this->key,
            "value" => json_decode($this->value),
            "description" => $this->description,
        ];
    }

    public function rules(): array
    {
        return [
            "value" => "required",
        ];
    }

    public function __toString(): string
    {
        return sprintf(
            "SettingDTO [id=%s, key=%s, value=%s, description=%s]",
            $this->id,
            $this->key,
            $this->value,
            $this->description
        );
    }
}
