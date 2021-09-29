<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Events extends Model
{
    //
    protected $fillable = [
        'name', 'slug','startTime','stopTime','maxUsers','mustBeMember'
    ];


    public function getStartTimeAttribute($value) {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }
    public function getStopTimeAttribute($value) {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    public function ticketTypes() {
        return $this->hasMany(EventTicketTypes::class);
    }
}

