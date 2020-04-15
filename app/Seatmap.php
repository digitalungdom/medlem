<?php

namespace App;

use App\Jobs\ImportSVGSeatmapJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Seatmap extends Model
{
    //
    protected $fillable = [
        'event'
    ];


    public static function importSVGJob($event) {
        $event = Events::find($event);
        ImportSVGSeatmapJob::dispatch($event);
    }

}
