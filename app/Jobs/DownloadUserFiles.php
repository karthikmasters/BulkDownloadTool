<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class DownloadUserFiles implements ShouldQueue
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
        // download user files
        $this->downloadFiles();
    }

    // Method to download the list of files
    protected function downloadFiles() {
        // storing few files on local storage for testing
        foreach(range(1, 5) as $aFile) {
            $sFile = "example" . $aFile . ".txt";
            if (!Storage::disk('local')->exists($sFile)) {
                Storage::disk('local')->put($sFile, 'Contents'); // storage/app/images
            }
        }
    }
}
