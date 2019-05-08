<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Division extends Model
{
    protected $table = 'division';

    public function insertDivision($data){

        DB::table('division')->insert($data);
    }

}
