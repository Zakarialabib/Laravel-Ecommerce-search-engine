<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreatePage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'page:create {title} {--components=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new page with specified components';

    public function handle()
    {
        $name = Str::snake($this->argument('title'));

        $components = json_decode($this->argument('components'), true);
    }
}
