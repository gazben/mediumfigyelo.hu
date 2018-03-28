<?php

namespace App\Services;

use App\Models\KeywordCount;
use App\Models\SiteState;
use Illuminate\Support\Collection;

class KeywordEvaluatorService
{
    protected $console = null;

    public function reEvaluate(Collection $keywords, Collection $sites, $console)
    {
        $this->console = $console;
        $this->deleteExistingKeywordCounts($keywords, $sites);

        return $this->findKeywords($keywords, $sites);
    }

    public function deleteExistingKeywordCounts(Collection $keywords, Collection $sites)
    {
        $siteIds = $sites->map(function($item){
            return $item->states()->select('id')->get();
        });
        // Remove old
        $keywordCounts = KeywordCount::whereIn('site_state_id', $siteIds->pluck('id'))
            ->whereIn('keyword_id', $keywords->pluck('id'))
            ->get();

        foreach ($keywordCounts as $entry) {
            $entry->delete();
        }
    }

    public function findKeywords(Collection $keywords, Collection $sites)
    {
        ini_set("memory_limit", '-1');
        $allCount = 0;
        foreach ($sites as $key => $site) {
            $siteStates = $site->states()->select('id')->get();
            // Do not query directly the states. The content can be big...
            // But not just the content, contchildren too...
            foreach ($siteStates as $state) {
                $state = SiteState::findOrFail($state->id);
                $this->console->info('Starting ' . $state->site->title);

                foreach ($keywords as $entry) {
                    $keyword = $entry->keyword;
                    $content = $state->content;

                    $count = mb_substr_count(
                        strtolower($content),
                        ' ' . strtolower($keyword) . ' '
                    );

                    $tempKeywordCount = new KeywordCount();
                    $tempKeywordCount->scrape_date = $state->scrape_date;
                    $tempKeywordCount->site_id = $state->site_id;
                    $tempKeywordCount->count = $count;
                    $tempKeywordCount->siteState()->associate($state);
                    $tempKeywordCount->keyword()->associate($entry);
                    $tempKeywordCount->save();
                    $allCount++;
                }

                $this->console->info('Site ' . $key .' / ' . $sites->count()
                    . ' | Found ' . $allCount . ' keywords. Memory: ' . ((memory_get_usage() / 1024.0) / 1024.0) . 'M');
            }
        }
    }
}
