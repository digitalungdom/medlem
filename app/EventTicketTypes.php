<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicketTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price','event_id','maxPerUser','description','enabled'
    ];
}
