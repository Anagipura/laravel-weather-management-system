<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pending_alerts extends Model
{
    protected $table = "pending_alerts";

    protected $fillable = [
        'city_id',
        'weather_record_id',
        'title',
        'message',
        'type',
        'location',
        'severity',
        'risk_score',
        'status',
        'source',
        'created_at'
    ];
}
