<?php

use Illuminate\Database\Seeder;

class OrganizationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('organization')->delete();
        
        \DB::table('organization')->insert(array (
            0 => 
            array (
                'id' => 1,
                'organization_name' => 'Test Organization',
                'br_number' => '4585522',
                'address' => 'No 10/12, 1st Lane, Colombo 12',
                'email' => 'testorg@testorg.com',
                'status' => '1',
            ),
        ));
        
        
    }
}