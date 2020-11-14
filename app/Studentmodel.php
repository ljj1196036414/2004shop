<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentmodel extends Model
{
    protected $table='student';
    protected $primaryKey='s_id';
    public $timestamps=false;
}
