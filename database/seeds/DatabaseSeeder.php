<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(env('APP_ENV') !== 'production'){
            $this->call(AddAdminUser::class);
        }

        $this->call(KeywordSeeder::class);
    }
}
