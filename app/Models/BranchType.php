<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BranchType extends Model
{
    protected $table = 'branch_type';

    public function updateBranchType($data,$where){

        $branchType = DB::table((new static)->getTable())
            ->where($where)
            ->update($data);

        return $branchType;
    }
    public function insertBranchType($data){

        DB::table('branch_type')->insert($data);
    }
    public function deleteBranchType($id){
        DB::table('branch_type')->where('id', '=', $id)->delete();
    }




}
