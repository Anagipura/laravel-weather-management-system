<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Nullable;

class Weather_records extends Model
{
    protected $table = "weather_records";

    protected $fillable = [
        'city_id',
        'temperature',
        'humidity',
        'wind_speed',
        'pressure',
        'rainfall',
        'description',
        'weather_main',
        'recorded_at',
        'created_at',
        'updated_at'
    ];
}
