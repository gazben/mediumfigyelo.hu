<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Site;
use GuzzleHttp\Client;
use ForceUTF8\Encoding;
use App\Models\SiteState;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ClientException;

class ScrapeService
{
    public function scrapeSite(Site $site) : ?SiteState
    {
        $client = new Client();
        $result = null;

        try {
            Log::info('Calling: ' . $site->method . ' ' . $site->url);
            $response = $client->request($site->method, $site->url);

            $result = $this->saveSiteState($site, $response->getBody()->getContents());
        } catch (ClientException | ServerException $exception) {
            Log::error($exception);

            return null;
        }

        return $result;
    }

    public function scrapeSites(Collection $sites) : Collection
    {
        $result = [];
        $promises = [];

        foreach ($sites as $site) {
            $promises[$site->id] = new Client();

            Log::info('Calling: ' . $site->method . ' ' . $site->url);
            $promises[$site->id] = $promises[$site->id]->requestAsync($site->method, $site->url);
            $promises[$site->id]->then(function ($response) use ($site, &$result) {
                $result[$site->id] = $this->saveSiteState($site, $response->getBody()->getContents());
            });
        }

        foreach ($promises as $key => $promise) {
            try {
                $promise->wait();
            } catch (ClientException $exception) {
                Log::error($exception);
            }
        }

        foreach ($result as $entry) {
            if (!$entry->save()) {
                 Log::error('SiteState cannot be saved: ' . $entry->site->title);
            }
        }

        return collect($result);
    }

    private function saveSiteState(Site $site, string $content) : SiteState
    {
        $result = new SiteState();
        $result->site()->associate($site);
        $result->content = Encoding::fixUTF8($content);
        $result->scrape_date = Carbon::now();

        return $result;
    }
}
