<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Lint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lint';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the syntax of the project';
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
        $process = new Process('vendor' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR .
            'parallel-lint --exclude vendor --exclude _ide_helper.php --exclude .phpstorm.meta.php .');

        return $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo "<error>" . $buffer . "</error>";
            } else {
                echo $buffer;
            }
        });
    }
}
