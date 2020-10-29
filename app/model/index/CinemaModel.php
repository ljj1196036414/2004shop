<?php
namespace App\model\index;
use Illuminate\Database\Eloquent\Model;
class CinemaModel extends Model
{
    protected $table='p_cinema';
    protected $primaryKey='cid';
    public $timestamps=false;
}

