<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PostnummerUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'postnummer:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Oppdater postnummer-tabellen fra Posten';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $postfil = Http::withOptions(['sink' => '/tmp/postnummer.txt'])->get('https://www.bring.no/postnummerregister-ansi.txt');

        // convert from ISO-8859-1 to UTF-8...
        $utf8 = iconv('ISO-8859-1', 'utf-8', file_get_contents('/tmp/postnummer.txt'));
        $utf8fil = fopen('/tmp/postnummer.utf.txt','w');
        fwrite($utf8fil, $utf8);
        fclose($utf8fil);

        $file = fopen('/tmp/postnummer.utf.txt','r');
        while($csvLine = fgetcsv($file,0,"\t")) {

            DB::table('postnumber')->updateOrInsert(
                ['postNummer' => $csvLine[0]],
                ['postSted' => $csvLine[1],
                'kommuneNummer' => $csvLine[2],
                'kommuneNavn' => $csvLine[3],
                'postNummerType' => $csvLine[4],
                'updated_at' => \Carbon\Carbon::now()]
            );
        }
    }
}
