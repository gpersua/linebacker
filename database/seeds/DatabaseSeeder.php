<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        $this->call(LbCountryTableSeeder::class);
        $this->call(LbStateTableSeeder::class);
        $this->call(LbCityTableSeeder::class);
        $this->call(LbMembershipTableSeeder::class);
        $this->call(LbAccountTableSeeder::class);
        $this->call(LbContactsTableSeeder::class);

        Model::reguard();
    }
}
