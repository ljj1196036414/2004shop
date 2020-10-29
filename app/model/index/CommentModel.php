<?php
namespace App\model\index;
use Illuminate\Database\Eloquent\Model;
class CommentModel extends Model
{
    protected $table='p_comment';
    protected $primaryKey='goods_id';
    public $timestamps=false;
}
