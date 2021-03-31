<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\LoaiTin;
class LoaiTinController extends Controller
{
   public function getDachSach(){
    	$loaitin = LoaiTin::all();//lấy tất cả thể loại
    	return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);//lấy dữ thể loại từ class LoaiTin
    }
    public function getThem(){
    	$theloai = TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function postThem(Request $request){//gọi phương thức request
    	$this->validate($request,
            [
                'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai'=>'required'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên',
                'Ten.unique'=>'Tên đã có',
                'Ten.min'=>'Độ dài ký tự [3,100]',
                'Ten.max'=>'Độ dài ký tự [3,100]',
                'TheLoai.required'=>'Bạn chưa chọn thể loại'
            ]
        );
        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Bạn đã thêm thành công');
    }
    public function getSua($id){
    	$loaitin = LoaiTin::find($id);
        $theloai = TheLoai::all();
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        $this->validate($request,
            [
                'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai'=>'required'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên',
                'Ten.unique'=>'Tên đã có',
                'Ten.min'=>'Độ dài ký tự [3,100]',
                'Ten.max'=>'Độ dài ký tự [3,100]',
                'TheLoai.required'=>'Bạn chưa chọn thể loại'
            ]
        );
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }

    public function getXoa($id){
        $loaitin = LoaiTin::find($id);

        $loaitin->delete();

        return redirect('admin/loaitin/danhsach')->with('thongbao','Bạn đã xoá thành công');
    }
}
