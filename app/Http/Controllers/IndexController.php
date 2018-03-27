<?php

namespace App\Http\Controllers;

use App\Http\Resources\KeywordResource;
use App\Http\Resources\SiteResource;
use App\Http\Resources\StatResource;
use App\Models\Keyword;
use App\Models\KeywordCount;
use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getKeywords()
    {
        return KeywordResource::collection(Keyword::all());
    }

    public function getSites()
    {
        return SiteResource::collection(Site::all());
    }

    /**
     * Get statistics on on hourly basis.
     *
     * @param Request $request
     *
     * @return string
     */
    public function getStats(Request $request)
    {
        $this->validate($request, [
            'keyword' => 'required|integer',
            'sites' => 'required|array',
            'dates' => 'required|array',
            'dates.beginDate' => 'required|string|max:50',
            'dates.endDate' => 'required|string|max:50',
        ]);

        $keyword = Keyword::findOrFail($request->get('keyword'));
        $sites = Site::findOrFail($request->get('sites'));
        $beginDate = Carbon::createFromFormat(Carbon::RSS, $request->get('dates')['beginDate'])->startOfDay();
        $endDate = Carbon::createFromFormat(Carbon::RSS, $request->get('dates')['endDate'])->addDay()->endOfDay();

        $faker = \Faker\Factory::create();
        $candleSize = 3; // skip this many hours

        $result = collect();
        foreach ($sites ?? [] as $site) {
            $siteKeywordCounts = KeywordCount::where('site_id', $site->id)
                ->where('keyword_id', $keyword->id)
                ->whereBetween('scrape_date', [$beginDate, $endDate])
                ->select(['count', 'scrape_date'])
                ->get();

            $siteKeywordCounts = $siteKeywordCounts->filter(function ($value) {
                return $value->scrape_date->hour <= 22 && $value->scrape_date->hour >= 7;
            })->nth($candleSize);

            $result->push([
                'label' => $site->title,
                'backgroundColor' => $faker->hexColor,
                'data' => $siteKeywordCounts->pluck('count'),
            ]);
        }

        // Get every 3 hours between (begin and end date) 7:00, 10:00, 13:00, 16:00, 19:00, 22:00
        $labels = collect();
        for($currentDate = $beginDate; $currentDate->lte($endDate); $currentDate->addHours($candleSize)) {
            if( $currentDate->hour <= 22 && $currentDate->hour >= 7){
                $labels->push($currentDate->format('Y-m-d H:i'));
            }
        }

        $result = [
            'labels' => $labels->toArray(),
            'datasets' => $result->toArray(),
        ];

        return json_encode(['data' => $result]);
    }
}
