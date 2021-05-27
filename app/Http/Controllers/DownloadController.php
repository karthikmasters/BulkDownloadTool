<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\DownloadUserFiles;
use Auth;
use App\User;

class DownloadController extends Controller
{
    // Dispatch Download Job
    public function dispatchJob() {

        // Getting file list
        $aFiles = Auth::user()->getFileList();

        // Setting Directory/Zip file name
        $sDirectory =  Auth::user()->id . "-" . date('Y-m-d-H-i-s');

        // Update download status to PROGRESS
        Auth::user()->download_status = 'PROGRESS';
        Auth::user()->download_link = $sDirectory . ".zip";
        Auth::user()->save();

        // Passing FileList and Directory parameters
        $downloadJob = new DownloadUserFiles($aFiles, $sDirectory);

        // Dispatching DownloadJob
        dispatch($downloadJob);
    }

    // Get download status
    public function getDownloadStatus() {

        // Get download status
        $sStatus = Auth::user()->download_status;

        if ($sStatus == 'READY') {
            $response = [
                'success' => true,
                'response' => $sStatus,
                'message' => 'Ready for download',
                'link' => Auth::user()->download_link,
            ];
        } elseif ($sStatus == 'PROGRESS') {
            $response = [
                'success' => true,
                'response' => $sStatus,
                'message' => 'Download In-Progress'
            ];
        } elseif ($sStatus == '') {
            $response = [
                'success' => true,
                'response' => '',
                'message' => 'Nothing is ready for download'
            ];
        } else {
            $response = [
                'success' => false,
                'response' => 'ERROR',
                'message' => 'Invalid request'
            ];
        }
        return response()->json($response);
    }
}
