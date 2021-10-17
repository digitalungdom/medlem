<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
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

    public function userIsMember($user = NULL) {
        if($user == NULL) $user = Auth::user();
        else $user = User::find($user);
        if($user->isMember) return true;

        return false;
    }

    public function eventIsOpen() {
        if($this->public) return true;
        return false;
    }
}

