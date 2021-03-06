<?php

use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Address::class, 50)->create()->each(function($u) {
            $u->save(factory(App\Address::class)->make());
        });
    }
}
