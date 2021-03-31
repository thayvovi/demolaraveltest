<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    use HasFactory;
    protected $table ="theloai";

	/*
	----> Tạo các liên kết
	 */
    public function loaitin(){
    	return $this->hasMany('App\Models\LoaiTin','idTheLoai','id');//model cần liên kết->id khoá ngoại->id khoá chính
    }

    public function tintuc(){
    	return $this->hasManyThrough('App\Models\TinTuc','App\Models\LoaiTin','idTheLoai','idLoaiTin','id');//Loaitin là trung gian voi idTheloai là foreign key table LoaiTin
    }
}
