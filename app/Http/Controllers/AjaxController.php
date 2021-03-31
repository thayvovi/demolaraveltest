<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TheLoai;

use App\Models\LoaiTin;

class AjaxController extends Controller
{
  public function getLoaiTin($idTheLoai){//vì bên route truyền 1 biến idTheLoai nên sẽ có 1 getID ở function
  	$loaitin = LoaiTin::where('idTheLoai',$idTheLoai)->get();//WHERE idTheLoai = $idTheLoai

  	foreach ($loaitin as $lt) {
  		echo "<option value='".$lt->id."'>".$lt->Ten."</option>";//Sau đó chạy thử http://localhost/demolaravel/public/admin/ajax/loaitin/2 xem có in ra danh sách không
  	}
  }
}

