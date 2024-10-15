<?php

namespace App\Actions;

use App\DTOs\DTO;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ValidateData {

    public function exceute(DTO $dto) {
        $validator = Validator::make($dto->toArray(), $dto->rules());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator;
    }

}