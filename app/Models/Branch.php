<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Branch extends Model
{
    protected $table = 'branch';


    public function getAllBranches($organization_id){

        $pagintaionEnabled = config('usersmanagement.enablePagination');

        $branches = DB::table('branch')
            ->where('branch.organization_id','=',$organization_id)
            ->join('branch_type', 'branch.branch_type', '=', 'branch_type.id')
            ->select('branch.*', 'branch_type.branch_type');
            if ($pagintaionEnabled) {
                $branches = $branches->paginate(config('usersmanagement.paginateListSize'));
            }else{
                $branches = $branches->get();
            }

        return $branches;
    }


    public function updateBranch($data,$where){

        $branch = DB::table('branch')
            ->where($where)
            ->update($data);

        return $branch;
    }



    public function insertBranch($data){

        DB::table('branch')->insert($data);
    }

    public function deleteBranch($id)
    {
        DB::table('branch')->where('id', '=', $id)->delete();
    }


}
