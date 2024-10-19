<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appliance extends Model
{
    use HasFactory;

    protected $table = 'appliances';
    protected $fillable = ['name', 'power_rating', 'usage_hours', 'units'];

    public function getAttribute($key)
    {
        return parent::getAttribute(\Illuminate\Support\Str::snake($key));
    }

    public function setAttribute($key, $value)
    {
        parent::setAttribute(\Illuminate\Support\Str::snake($key), $value);
    }
}
