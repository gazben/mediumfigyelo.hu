<?php

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // (title, description, url, method, owner)
        $sites = [
            // National online
            ['Index.hu', '', 'https://index.hu/', 'GET', ''],
            ['444.hu', '', 'https://444.hu/', 'GET', ''],
            ['888.hu', '', 'https://888.hu/', 'GET', ''],
            ['Origo.hu', '', 'https://origo.hu/', 'GET', ''],
            // Wtf online
            ['Ripost.hu', '', 'https://ripost.hu/', 'GET', ''],
            ['Pestisracok.hu', '', 'https://pestisracok.hu/', 'GET', ''],
            // County online
            ['Kisalföld', '', 'http://www.kisalfold.hu/', 'GET', ''],
            ['Békés Megyei Hírlap', '', 'https://www.beol.hu/', 'GET', ''],
            ['Info-Győr', '', 'http://www.infogyor.hu/', 'GET', ''],
        ];

        foreach ($sites as $site) {
            $entity = Site::firstOrNew([
                'title' => $site[0]
            ]);
            $entity->title = $site[0];
            $entity->description = $site[1];
            $entity->url = $site[2];
            $entity->method = $site[3];
            $entity->owner = $site[4];
            $entity->save();
        }
    }
}
