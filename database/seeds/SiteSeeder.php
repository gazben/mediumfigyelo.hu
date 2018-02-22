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
            ['TEOL online', '', 'https://www.teol.hu/', 'GET', ''],
            ['BAMA online', '', 'https://www.bama.hu/', 'GET', ''],
            ['KEON online', '', 'http://www.keon.hu/', 'GET', ''],
            ['Szabolcs Online', '', 'http://www.szon.hu/', 'GET', ''],
            ['Civishir', '', 'http://civishir.hu/', 'GET', ''],
            ['SZOLJON online', '', 'https://www.szoljon.hu/', 'GET', ''],
            ['Heol.hu', '', 'https://www.heol.hu/', 'GET', ''],
            ['Kemma.hu', '', 'https://www.kemma.hu/', 'GET', ''],
            ['Baon.hu', '', 'https://www.baon.hu/', 'GET', ''],
            ['Vaol.hu', '', 'https://www.vaol.hu/', 'GET', ''],
            ['Feol.hu', '', 'https://www.feol.hu/', 'GET', ''],
            ['Duol.hu', '', 'https://www.duol.hu/', 'GET', ''],
            ['Zaol.hu', '', 'https://www.zaol.hu/', 'GET', ''],
            ['Veol.hu', '', 'https://www.veol.hu/', 'GET', ''],
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
