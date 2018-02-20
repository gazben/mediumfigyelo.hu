<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class KeywordEvaluatorService
{
    public function evaluate(
        Collection $keywords,
        Collection $sites,
        Carbon $from,
        Carbon $to,
        Carbon $interval
    ) {
        return; // TODO
    }
}