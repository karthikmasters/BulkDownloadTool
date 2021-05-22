<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use File;


class DownloadUserFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $aFiles;
    public $sDirectory;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($aList, $sDirectory)
    {
        $this->aFiles = $aList;
        $this->sDirectory = $sDirectory;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Downloading the files
        $this->downloadFiles();

        // Archiving
        $this->archive();
    }

    // Method to download the list of files
    protected function downloadFiles() {
        $aFiles = $this->aFiles;

        foreach($aFiles as $aFile) {
            $sFile = $this->sDirectory . $aFile;
            if (!Storage::disk('local')->exists($sFile)) {
                Storage::disk('local')->put($sFile, 'Contents'); // storage/app/images
                sleep(10);
            }
        }
    }

    // Method to archive the downloaded folder
    protected function archive() {

        // Instantiating Zip object
        $oZip = new ZipArchive;
        $directory = 'app/' . $this->sDirectory;

        // Retrieving downloaded files
        $files = File::allFiles(storage_path($directory));

        // Archiving logic
        $fileName = $this->sDirectory . '.zip';
        if ($oZip->open(public_path($fileName), ZipArchive::CREATE) == TRUE) {
            foreach ($files as $aFile) {
                $filePath = explode($this->sDirectory, base_path($aFile));
                $sFilePath = substr(str_replace('\\', '/', $filePath[1]), 1);
                $oZip->addFile($aFile, $sFilePath);
            }
            $oZip->close();
        }
    }
}
