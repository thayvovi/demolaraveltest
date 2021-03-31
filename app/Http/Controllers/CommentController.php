<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;//gọi thư viện str

use Illuminate\Support\Facades\Auth;

use App\Models\TheLoai;

use App\Models\LoaiTin;

use App\Models\TinTuc;

use App\Models\Comment;

class CommentController extends Controller
{
    public function getXoa($id,$idTinTuc){
        $comment = Comment::find($id);

        $comment->delete();

        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao','Bạn đã xoá comment thành công');
    }

    public function postComment($id, Request $request){
    	$idTinTuc = $id;
    	$tintuc = TinTuc::find($id);
    	$comment = new Comment;
    	$comment->idTinTuc = $idTinTuc;
    	$comment->idUser = Auth::user()->id;
    	$comment->NoiDung = $request->NoiDung;
    	$comment->save();
    	return redirect("tintuc/".$idTinTuc."/".$tintuc->TieuDeKhongDau.".html");
    }
}
