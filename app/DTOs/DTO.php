<?php

namespace App\DTOs;

interface DTO {
    public function toArray(): array;
    public function rules(): array;
}