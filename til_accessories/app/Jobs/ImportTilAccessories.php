<?php

namespace App\Jobs;

use App\Imports\TilAccessoriesImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ImportTilAccessories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // /**
    //  * The full file path for the import.
    //  *
    //  * @var string
    //  */
    // protected $filePath;



    // public function __construct($filePath)
    // {
    //     $this->filePath = $filePath;
    // }

    // public function handle()
    // {
    //     dd($this->filePath);
    //     Excel::import(new TilAccessoriesImport($this->filePath), $this->filePath);
    // }

    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        ini_set('memory_limit', '3355443200'); // 3.2GB
        ini_set('max_execution_time', 3000); // 50 minutes
    }

    public function handle()
    {
        Excel::import(new TilAccessoriesImport($this->filePath), $this->filePath);
    }



}
