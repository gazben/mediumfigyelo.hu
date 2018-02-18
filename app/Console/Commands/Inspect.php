<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Inspect extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inspect the project with phpmd';

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
        $process = new Process('vendor' . DIRECTORY_SEPARATOR
            . 'bin' . DIRECTORY_SEPARATOR . 'phpmd app text phpmd.xml');

        return $process->run(function ($type, $buffer) {
            echo $buffer;
        });
    }
}
