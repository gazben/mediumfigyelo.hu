<?php

namespace App\Console\Commands;

use App\Models\Site;
use App\Services\ScrapeService;
use Illuminate\Console\Command;

class ScrapeSite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:site';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape the ';

    private $scrapeService;

    /**
     * Create a new command instance.
     *
     * @param ScrapeService $scrapeService
     */
    public function __construct(ScrapeService $scrapeService)
    {
        parent::__construct();
        $this->scrapeService = $scrapeService;
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $sites = Site::all();
        $this->info('Scraping ' . $sites->count() . ' sites.');
        $result = $this->scrapeService->scrapeSites($sites);
        $this->info('Scraped ' . $result->count() . ' sites.');
        $this->info('Command completed.');
    }
}
