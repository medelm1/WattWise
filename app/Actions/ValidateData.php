<?php

namespace App\Actions;

use App\DTOs\DTO;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Validator;

class ValidateData {

    public function execute(DTO $dto) {
        $validator = Validator::make($dto->toArray(), $dto->rules());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator;
    }

}