<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Country::class, 50)->create()->each(function($u) {
            $u->save(factory(App\Country::class)->make());
        });
    }
}
