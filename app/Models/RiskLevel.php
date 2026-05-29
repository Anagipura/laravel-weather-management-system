<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiskLevel extends Model
{
    protected $fillable = [
        "country", // LK/ IND/ MV
        "risklevel", // low/ medium/ high
        "description",
    ];
}
