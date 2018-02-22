<?php

use App\Models\Keyword;
use Illuminate\Database\Seeder;

class KeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keywords = [
          'soros',
        ];

        foreach ($keywords as $keyword) {
            $entity = Keyword::firstOrNew([
                'keyword' => $keyword
            ]);
            $entity->keyword = $keyword;
            $entity->save();
        }
    }
}
