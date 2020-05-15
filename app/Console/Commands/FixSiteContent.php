<?php

namespace App\Console\Commands;

use App\Models\Site;
use App\Models\SiteState;
use \ForceUTF8\Encoding;
use Illuminate\Console\Command;

class FixSiteContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:encoding';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix site content encoding';

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
     */
    public function handle()
    {
        $this->info('Fixation in progress...');
        $sites = Site::all();
        $siteStatesCount = SiteState::count();
        $currentCount = 0;

        foreach ($sites as $key => $site) {
            $siteStates = $site->states()->select('id')->get();

            foreach ($siteStates as $state) {
                $state = SiteState::findOrFail($state->id);
                $state->content = Encoding::fixUTF8($state->content);
                $state->save();

                $this->info('Progress: ' . $currentCount++ . '/' . $siteStatesCount);
            }
        }
    }
}
