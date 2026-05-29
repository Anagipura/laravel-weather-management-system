<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\alert;

class Alert extends Model
{
   protected $fillable = [
       'title',
       'message',
       'type',
       'location',
       'severity',
   ];
}
