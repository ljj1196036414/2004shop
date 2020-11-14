<?php

namespace App\model\index;

use Illuminate\Database\Eloquent\Model;

class CouponModel extends Model
{
    protected $table='p_coupons';
    protected $primaryKey='id';
    public $timestamps=false;
}
