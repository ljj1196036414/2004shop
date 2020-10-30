<?php

namespace App\model\index;

use Illuminate\Database\Eloquent\Model;

class PersonalModel extends Model
{
    protected $table='personal';
    protected $primaryKey='personal_id';
    public $timestamps=false;
}
