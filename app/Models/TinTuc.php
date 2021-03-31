<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    use HasFactory;
    protected $table ="tintuc";

    /*
    Vì trong loại tin có liên kết đến theloai nên không cần function theloai ở model tintuc
     */
    public function loaitin()
    {
        return $this->belongsTo('App\Models\LoaiTin','idLoaiTin','id');
    }
    public function comment(){
    	return $this->hasMany('App\Models\Comment','idTinTuc','id');
    }
}
