<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the phpunit tests';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (env('APP_ENV') == 'production') {
            $this->error('Ezt a parancsot production szerveren nem futtathatod!');
        }

        $process = new Process('vendor' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR .
            'phpunit -v -c phpunit.xml');
        $process->setWorkingDirectory(base_path());

        return $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo "<error>" . $buffer . "</error>";
            } else {
                echo $buffer;
            }
        });
    }
}
