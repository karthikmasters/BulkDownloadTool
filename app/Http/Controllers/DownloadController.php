<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\DownloadUserFiles;
use Auth;

class DownloadController extends Controller
{
    // Dispatch Download Job
    public function dispatchJob() {

        // Getting file list
        $aFiles = Auth::user()->getFileList();

        // Setting Directory/Zip file name
        $sDirectory =  Auth::user()->id . "-" . date('Y-m-d-H-i-s');

        // Passing FileList and Directory parameters
        $downloadJob = new DownloadUserFiles($aFiles, $sDirectory);

        // Dispatching DownloadJob
        dispatch($downloadJob);
    }
}
