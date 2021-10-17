<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

use App\Postnumber;

class PostNumberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $file_url = "https://www.bring.no/postnummerregister-ansi.txt";

        $response = Http::get($file_url);
        $body = $response->body();
        #$utf = utf8_encode($body);
        
        $utf = iconv("WINDOWS-1252", "UTF-8", $body);
        $array = preg_split("/\r\n|\n|\r/", $utf);

        #print_r($response->body());
        foreach($array as $line) {
            #$data = preg_split('/\s+/', $line);
            $data = preg_split('/\t/', $line);
            if($data[0] && $data[1]) {
                echo $data[0]."\n";
                $postnumber = Postnumber::firstOrNew(['postNummer' => $data[0]]);
                $postnumber->postSted = iconv("WINDOWS-1252", "UTF-8", $data[1]);
                $postnumber->kommuneNummer = $data[2];
                $postnumber->kommuneNavn = iconv("WINDOWS-1252", "UTF-8",$data[3]);
                $postnumber->postNummerType = $data[4];
                $postnumber->save();
            }
            
        }


    }
}
