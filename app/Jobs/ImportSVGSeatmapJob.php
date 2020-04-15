<?php

namespace App\Jobs;

use App\Events;
use App\Seat;
use App\Seatmap;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImportSVGSeatmapJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */


    public $event;
    public function __construct(Events $event)

    {
        //
        $this->event = $event;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $event = Events::find($this->event)->first();

        $seatmap = Seatmap::firstOrNew(['event' => $event->id]);
        $seatmap->save();
        #Log::debug('Fant seatmap', ['seatmap' => $seatmap]);
        $fil = Storage::get('seatmap_original/GL30_hallkart.svg');
        $stripped = strip_tags($fil, '<rect><text><svg>');

        $xml = simplexml_load_string($stripped);

        foreach($xml as $shape => $value) {
            #echo($shape->attributes()->id."\n");
            Log::debug($seatmap->id);
            $seat = Seat::firstOrNew(['seatmap' => $seatmap->id, 'svgid' => $value->attributes()->id ] );
            $seat->svgtype = $shape;

            switch($shape) {
                case 'rect':

                    $seat->svgX1 = $value->attributes()->x;
                    $seat->svgY1 = $value->attributes()->y;
                    $seat->width = $value->attributes()->width;
                    $seat->height = $value->attributes()->height;
                break;
                case 'text':
                    $seat->svgX1 = $value->attributes()->x;
                    $seat->svgY1 = $value->attributes()->y;
                break;
            } // End switch
            $seat->save();
        } // end foreach

    }
}
