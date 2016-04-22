<?php

use Illuminate\Database\Seeder;

class LbCountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lb_country')->insert([
            'idlb_country' => 1,
            'name' => 'USA',
        ]);
    }
}
