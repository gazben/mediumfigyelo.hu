<?php

namespace App\Console\Commands;

use App\Models\Keyword;
use App\Models\Site;
use App\Services\KeywordEvaluatorService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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

        $this->info('Evaluation started.');

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

        DB::transaction(function () use ($keywords, $sites) {
            $this->keywordEvaluatorService->reEvaluate($keywords, $sites, $this);
        });

        $this->info('Sok boldogsagot...');
    }
}
