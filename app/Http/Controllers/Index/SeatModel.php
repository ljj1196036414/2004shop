<?php
namespace App\model\index;
use Illuminate\Database\Eloquent\Model;
class SeatModel extends Model
{
    protected $table='seat';
    protected $primaryKey='sid';
    public $timestamps=false;
}

