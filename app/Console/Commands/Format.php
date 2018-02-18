<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Format extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'format';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Formats the app, bootstrap, config, database, routes, tests folders to the psr2 standard';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function handle()
    {
        $process = new Process('vendor' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR
            .'phpcbf  --standard=psr2 --tab-width=4 app database');

        return $process->run(function ($type, $buffer) {
            echo $buffer;
        });
    }
}
