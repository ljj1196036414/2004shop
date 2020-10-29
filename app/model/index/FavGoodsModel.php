<?php

namespace App\model\index;

use Illuminate\Database\Eloquent\Model;

class FavGoodsModel extends Model
{
    protected $table='p_fav_goods';
    protected $primaryKey='id';
    public $timestamps=false;
}

