<?php

use Illuminate\Database\Seeder;

class BranchTypeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('branch_type')->delete();
        
        \DB::table('branch_type')->insert(array (
            0 => 
            array (
                'id' => 1,
                'branch_type' => 'Regional Branch ',
                'status' => '1',
            ),
        ));
        
        
    }
}