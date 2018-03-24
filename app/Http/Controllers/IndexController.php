<?php

namespace App\Http\Controllers;

use App\Http\Resources\KeywordResource;
use App\Http\Resources\SiteResource;
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


    }
}
