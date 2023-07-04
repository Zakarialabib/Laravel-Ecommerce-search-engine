<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Imports\ImportUpdates;
use App\Imports\ProductImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Trait\QueueProgress;

class ProductJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use QueueProgress;

    /**
     * The name of the output file.
     *
     * @var string
     */
    protected $filename;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /** Execute the job. */
    public function handle(): void
    {
        $this->setProgress(0);

        sleep(2);

        $this->setProgress(35);

       Excel::import(new ProductImport(), public_path('images/products/'.$this->filename));

        sleep(2);

        $this->setProgress(75);

       File::delete(public_path('images/products/'.$this->filename));

        sleep(2);

        $this->setProgress(100);
      

      
    }
}
