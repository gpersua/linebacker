<?php

use Illuminate\Database\Seeder;

class LbContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $lb_contacts=[['id' =>1, 'userAcc'=>'0802b0a6-f7ad-4d32-b44b-7736b69410b2', 'first_name'=>'Free T-Mobile SMS for VVM', 'last_name'=>'', 'address' => 'my address', 'email' => 'myemail@domain.com', 'primary_phone' => '122', 'second_phone'=> '129', 'third_phone'=> '']];
            DB::table('lb_contacts')->insert($lb_contacts);
    }
}
