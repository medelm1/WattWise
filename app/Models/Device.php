<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'devices';

    protected $fillable = ['name', 'power_rating', 'usage_hours'];

    public function getAttribute($key)
    {
        $snakeCaseKey = \Illuminate\Support\Str::snake($key);
        return parent::getAttribute($snakeCaseKey);
    }

    public function setAttribute($key, $value)
    {
        $snakeCaseKey = \Illuminate\Support\Str::snake($key);
        return parent::setAttribute($snakeCaseKey, $value);
    }
}
