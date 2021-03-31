<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TheLoai;
class TheLoaiController extends Controller
{
    public function getDachSach(){
    	$theloai = TheLoai::all();//lấy tất cả thể loại
    	return view('admin.theloai.danhsach',['theloai'=>$theloai]);//lấy dữ thể loại từ class TheLoai
    }
    public function getThem(){
    	return view('admin.theloai.them');
    }
    public function postThem(Request $request){//gọi phương thức request
    	$this->validate($request,
    	[
    		'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
    	],
    	[
    		'Ten.required'=>'Bạn chưa nhập tên thể loại',
            'Ten->unique' => 'Tên thể loại đã tồn tại',
    		'Ten.min' => 'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
    		'Ten.max' => 'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự'
    	]
    	);//truyền 2 thàm số: mảng 1 là lỗi, mảng 2 là kq hiển thị
    	$theloai = new TheLoai;//khởi tạo lại thể loại để thêm
    	$theloai->Ten = $request->Ten;//->name với name phải trùng với cột trên database
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/them')->with('thongbao','Thêm Thành Công');
    }
    public function getSua($id){
    	$theloai = TheLoai::find($id);//lấy thông tin id cần sửa
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
        $theloai = TheLoai::find($id);//Tìm đến id cần sửa trên db
        $this->validate($request,
            [
                'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'//ktra nhap chua|trung|độ dài
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên thể loại',
                'Ten.unique' => 'Tên Thể loại đã tồn tại',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
                'Ten.max' => 'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự'
            ]
        );
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa Thành Công');
    }

    public function getXoa($id){
        $theloai = TheLoai::find($id);

        $theloai->delete();

        return redirect('admin/theloai/danhsach')->with('thongbao','Bạn đã xoá thành công');
    }

}
