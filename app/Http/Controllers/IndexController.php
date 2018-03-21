<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Models\Site;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getKeywords()
    {
        return json_encode([
            'data' => Keyword::all(['id', 'keyword']),
        ]);
    }

    public function getSites()
    {
        return json_encode([
            'data' => Site::all(),
        ]);
    }

    /**
     * Get statistics on on hourly basis.
     *
     * @param Request $request
     * @param $hour
     *
     * @return string
     */
    public function getStatistics(Request $request, $hour)
    {
        $data = [];

        // Filtering is done on the frontend
        $data['keywords'] = Keyword::all(['id', 'keyword']);

        return json_encode([
            'data' => $data,
        ]);

    }
}
