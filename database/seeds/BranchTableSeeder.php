<?php

use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('branch')->delete();
        
        \DB::table('branch')->insert(array (
            0 => 
            array (
                'id' => 1,
                'organization_id' => 1,
                'branch_code' => 'BR001',
                'branch_name' => 'Test Branch',
                'branch_type' => 1,
                'contact_number' => 714230057,
                'email' => 'sasi.spenzer@gmail.com',
                'address' => '10/12 Colombo 10',
                'status' => '1',
            ),
        ));
        
        
    }
}