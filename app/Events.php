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
        'name', 'slug','startTime','stopTime','maxUsers','mustBeMember','event_types_id'
    ];


    public function getStartTimeAttribute($value) {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }
    public function getStopTimeAttribute($value) {
        return Carbon::parse($value)->format('Y-m-d\TH:i');
    }

    public function ticketTypes() {
        return $this->hasMany(EventTicketTypes::class, 'event_id');
    }
    public function tickets($user = "NOTSET") {
        $ticketTypes = $this->ticketTypes()->pluck('id');
        if($user == "NOTSET") $user = auth()->user()->id;
        #dd($ticketTypes);
        #dd($user);
        #return $this->hasMany(Ticket::class)
        #    ->where('owner', $user)
        #    ->where('ticketType', $ticketTypes);
        return $this->hasManyThrough(Ticket::class, EventTicketTypes::class, 'event_id', 'ticketType');
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

    public function eventtype() {
        return $this->belongsTo(EventType::class, 'event_types_id');
    }
}

