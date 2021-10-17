<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postnumber extends Model
{
    use HasFactory;
    protected $table = 'postnumber';
    protected $fillable = [
        'postNummer', 'postSted','kommuneNummer','kommuneNavn','postNummerType'
    ];
}
