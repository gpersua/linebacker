<?php

use Illuminate\Database\Seeder;

class LbAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $lb_account=[['id' =>1, 'userAcc'=>'0802b0a6-f7ad-4d32-b44b-7736b69410b2', 'id_membership'=> '1', 'id_city'=> '1', 'first_name'=>'Free T-Mobile SMS for VVM', 'last_name'=>'', 'address' => 'my address', 'birthday' => '2001-01-01', 'phone_number' => '7276988553', 'second_phone'=> '']];
            DB::table('lb_account')->insert($lb_account);
    }
}
