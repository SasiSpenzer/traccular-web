<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DivisionType extends Model
{
    protected $table ='division_type';

    public function getAllDivisionTypesByOrgId($id){

        $divisionTypes = $branches = DB::table('division_type')
            ->where('division_type.organization_id','=',$id)
            ->get();

        return $divisionTypes;
    }

}
