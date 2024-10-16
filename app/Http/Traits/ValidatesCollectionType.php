<?php

namespace App\Http\Traits;

use Illuminate\Support\Collection;

trait ValidatesCollectionType
{
    protected function isCollectionOfType(Collection $collection, $type): bool
    {
        return $collection->every(fn($item) => $item instanceof $type);
    }
}