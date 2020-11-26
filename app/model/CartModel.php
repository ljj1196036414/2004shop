<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    protected $table='p_cart';
    protected $primaryKey='id';
    public $timestamps=false;
}
