<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    //
    protected $fillable = [
        'name', 'maxAge','minAge','price','hidden'
    ];
}
