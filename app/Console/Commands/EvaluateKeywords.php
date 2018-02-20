<?php

namespace App\Console\Commands;

use App\Models\Keyword;
use App\Models\Site;
use App\Services\KeywordEvaluatorService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EvaluateKeywords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:evaluate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Search the site states for the keywords';

    private $keywordEvaluatorService;

    /**
     * Create a new command instance.
     *
     * @param KeywordEvaluatorService $keywordEvaluatorService
     */
    public function __construct(KeywordEvaluatorService $keywordEvaluatorService)
    {
        parent::__construct();
        $this->keywordEvaluatorService = $keywordEvaluatorService;
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $sites = Site::all();
        $keywords = Keyword::all();
        $from = Carbon::now();
        $to = Carbon::now();
        $interval = Carbon::now()->hour(0)->minute(30);

        $this->info('Evaluation started.');
        $this->info('From: ' . $from->format('Y-m-d H:i'));
        $this->info('To: ' . $to->format('Y-m-d H:i'));
        $this->info('Interval: ' . $interval->format('H:i'));

        $this->info('');
        $this->info('Sites: ' . $sites->count());
        foreach ($sites as $site) {
            $this->info($site->title . ' ' . $site->url);
        }

        $this->info('');
        $this->info('Keywords: ' . $keywords->count());
        foreach ($keywords as $keyword) {
            $this->info($keyword->keyword);
        }

        $this->keywordEvaluatorService->evaluate($keywords, $sites, $from, $to, $interval);

        $this->info('Sok boldogsagot...');
    }
}
