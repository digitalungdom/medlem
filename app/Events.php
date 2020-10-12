<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Events extends Model
{
    //
    protected $fillable = [
        'name', 'slug','startTime','stopTime'
    ];
}
