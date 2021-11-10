<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DeployController extends Controller
{
    //

    public function deploy(Request $request) {
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');

        $localToken = config('app.deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);
        Log::info("Starting check for deployment");
        if(hash_equals($githubHash, $localHash)) {
            $root_path = base_path();
            $process = new Process(['cd', $root_path ,'; ./deploy.sh']);
            try {
                $process->run();
                Log::info($process->getOutput());
            } catch (ProcessFailedException $e) {
                Log::error( $e->getMessage() );
            }
            Log::info('Should have updated from git now');
            
        } else {
            Log:error("Something was wrong with github hash. Update failed");
        }
    }
}
