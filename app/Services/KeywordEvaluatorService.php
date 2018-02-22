<?php

namespace App\Services;

use App\Models\KeywordCount;
use App\Models\SiteState;
use Illuminate\Support\Collection;

class KeywordEvaluatorService
{
    public function reEvaluate(Collection $keywords, Collection $sites)
    {
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

    public function findKeywords(Collection $keywords, Collection $sites) : Collection
    {
        $keywordCounts = collect();
        foreach ($sites as $site) {
            // Do not query directly the states. The content can be big...
            // But not just the content, contchildren too...
            foreach ($site->states()->select('id')->get() as $state) {
                $state = SiteState::findOrFail($state->id);

                foreach ($keywords as $entry) {
                    $count = substr_count(
                        strtolower($state->content),
                        ' ' . strtolower($entry->keyword) . ' '
                    );

                    $tempKeywordCount = new KeywordCount();
                    $tempKeywordCount->count = $count;
                    $tempKeywordCount->siteState()->associate($state);
                    $tempKeywordCount->keyword()->associate($entry);
                    // Do not save here. Save in the end. Maybe it will be faster...

                    $keywordCounts->push($tempKeywordCount);
                }
            }
        }

        foreach ($keywordCounts as $keywordCount) {
            $keywordCount->save();
        }

        return $keywordCounts;
    }
}
