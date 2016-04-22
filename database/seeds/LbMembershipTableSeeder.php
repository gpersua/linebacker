<?php

use Illuminate\Database\Seeder;

class LbMembershipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $lb_membership=[['idlb_membership' =>1, 'description'=>'Free']];
            DB::table('lb_membership')->insert($lb_membership);
    }
}
