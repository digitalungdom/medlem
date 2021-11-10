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
        #if(true) {
            $root_path = base_path();
            Log::info("Root:" . $root_path);
            $process = new Process(['./deploy.sh']);
            $process->setWorkingDirectory($root_path);
            
            try {
                $process->mustRun();
                Log::info($process->getOutput);
            Log::info($process->getOutput());
            } catch (ProcessFailedException $e) {
                Log::error("Error: ".$e->getMessage() );
            }
            Log::info('Should have updated from git now');
            
        } else {
            Log::error("Something was wrong with github hash. Update failed");
        }
    }
}
