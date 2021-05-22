<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\DownloadUserFiles;

class DownloadController extends Controller
{
    // Dispatch Download Job
    public function dispatchJob() {
        $downloadJob = new DownloadUserFiles();
        dispatch($downloadJob);
    }
}
