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
            ['Index.hu', '', 'https://index.hu/', 'GET', ''],
        ];

        foreach ($sites as $site) {
            $entity = new Site();
            $entity->title = $site[0];
            $entity->description = $site[1];
            $entity->url = $site[2];
            $entity->method = $site[3];
            $entity->owner = $site[4];
            $entity->save();
        }
    }
}
