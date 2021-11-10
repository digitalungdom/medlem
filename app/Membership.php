<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Membership extends Model
{
    //
    protected $fillable = [
        'user_id','is_paid'
    ];
    
}
