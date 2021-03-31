<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;//gọi thư viện str
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\TinTuc;
use App\Models\Comment;

class TinTucController extends Controller
{
    public function getDachSach(){
    	$tintuc = TinTuc::orderBy('id','DESC')->get();//lấy dữ liệu từ dưới lên
    	return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);//lấy dữ thể loại từ class LoaiTin
    }
    public function getThem(){
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.them',['theloai'=>$theloai],['loaitin'=>$loaitin]);
    }
    public function postThem(Request $request){//gọi phương thức request
    	$this->validate($request,
    		[
    			'LoaiTin'=>'required',
    			'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
    			'TomTat'=>'required|min:10',
    			'NoiDung'=>'required'
    		],
    		[
    			'LoaiTin.required'=>'Bạn chưa chọn Loại Tin',
    			'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
    			'TieuDe.min'=>'Tiêu đề ít nhất 3 ký tự trở lên',
    			'TieuDe.unique'=>'Tiêu đề đã tồn tại',
    			'TomTat.required'=>'Bạn chưa nhập Tóm Tắt',
    			'TomTat.min'=>'Tóm tắt ít nhất 10 ký tự',
    			'NoiDung.required'=>'Bạn chưa nhập nội dung'
    		]
    	);

    	$tintuc = new TinTuc;
    	$tintuc->TieuDe =$request->TieuDe;
    	$tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
    	$tintuc->idLoaiTin = $request->LoaiTin;
    	$tintuc->TomTat = $request->TomTat;
    	$tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;
    	$tintuc->SoLuotXem = 0;

    	if ($request->hasFile('Hinh')) {//Kiểm tra xem có hình truyền lên không
    		
    		$file = $request->file('Hinh');//lưu hình vào biến file
    		$duoi = $file->getClientOriginalExtension();
    		if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'gif' && $duoi != 'jpeg') {
    			return redirect('admin/tintuc/them')->with('loi','File của bạn phải có định dạng jpg,png,gif,jpge');
    		}
    		$name = $file->getClientOriginalName();//lấy tên hình
    		$Hinh = str::random(4)."_".$name;
    		//echo $Hinh;//test thử xem đặt tên thế nào trước đó phải bỏ $bien->save() để không lưu
    		while (file_exists("upload/tintuc/".$Hinh)) {//kiểm tra tồn tại chưa nếu trùng thì lặp cho đến khi không bị trùng
    		    $Hinh = str::random(4)."_".$name;//với hinh bảng tên người dùng đặt và trước tên gốc là ký tự random
    		}
    		
    		$file->move('upload/tintuc/',$Hinh);//lưu hình
    		
    		$tintuc->Hinh = $Hinh;
    		/*
    			//Lấy Tên files
	            echo 'Tên Files: ' . $file->getClientOriginalName();
	            echo '<br/>';

    			//Lấy Đuôi File
	            echo 'Đuôi file: ' . $file->getClientOriginalExtension();
	            echo '<br/>';

	            //Lấy đường dẫn tạm thời của file
	            echo 'Đường dẫn tạm: ' . $file->getRealPath();
	            echo '<br/>';

	            //Lấy kích cỡ của file đơn vị tính theo bytes
	            echo 'Kích cỡ file: ' . $file->getSize();
	            echo '<br/>';

	            //Lấy kiểu file
	            echo 'Kiểu files: ' . $file->getMimeType();
	            */
    	} else{
    		$tintuc->Hinh = "";
    	}
    	$tintuc->save();
    	return redirect('admin/tintuc/them')->with('thongbao','Bạn đã thêm thành công');
    }
    public function getSua($id){
    	$tintuc = tintuc::find($id);
        $loaitin = LoaiTin::all();
        $theloai = TheLoai::all();
    	return view('admin.tintuc.sua',['tintuc'=>$tintuc,'loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id){
       $tintuc = TinTuc::find($id);
       $this->validate($request,
    		[
                'LoaiTin'=>'required',
                'TomTat'=>'required|min:10',
                'NoiDung'=>'required'
            ],
            [
                'LoaiTin.required'=>'Bạn chưa chọn Loại Tin',
                'TomTat.required'=>'Bạn chưa nhập Tóm Tắt',
                'TomTat.min'=>'Tóm tắt ít nhất 10 ký tự',
                'NoiDung.required'=>'Bạn chưa nhập nội dung'
            ]
    	);
       	$tintuc->TieuDe =$request->TieuDe;
    	$tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
    	$tintuc->idLoaiTin = $request->LoaiTin;
    	$tintuc->TomTat = $request->TomTat;
    	$tintuc->NoiDung = $request->NoiDung;
        $tintuc->NoiBat = $request->NoiBat;

    	if ($request->hasFile('Hinh')) {//Kiểm tra xem có hình truyền lên không
    		
    		$file = $request->file('Hinh');//lưu hình vào biến file
    		$duoi = $file->getClientOriginalExtension();
    		if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'gif' && $duoi != 'jpeg') {
    			return redirect('admin/tintuc/sua/'.$id)->with('loi','File của bạn phải có định dạng jpg,png,gif,jpge');
    		}
    		$name = $file->getClientOriginalName();//lấy tên hình
    		$Hinh = str::random(4)."_".$name;
    		//echo $Hinh;//test thử xem đặt tên thế nào trước đó phải bỏ $bien->save() để không lưu
    		while (file_exists("upload/tintuc/".$Hinh)) {//kiểm tra tồn tại chưa nếu trùng thì lặp cho đến khi không bị trùng
    		    $Hinh = str::random(4)."_".$name;//với hinh bảng tên người dùng đặt và trước tên gốc là ký tự random
    		}
    		$file->move('upload/tintuc/',$Hinh);//lưu hình
    		unlink("upload/tintuc/".$tintuc->Hinh);//xoá file cũ
    		
    		$tintuc->Hinh = $Hinh;
    		/*
    			//Lấy Tên files
	            echo 'Tên Files: ' . $file->getClientOriginalName();
	            echo '<br/>';

    			//Lấy Đuôi File
	            echo 'Đuôi file: ' . $file->getClientOriginalExtension();
	            echo '<br/>';

	            //Lấy đường dẫn tạm thời của file
	            echo 'Đường dẫn tạm: ' . $file->getRealPath();
	            echo '<br/>';

	            //Lấy kích cỡ của file đơn vị tính theo bytes
	            echo 'Kích cỡ file: ' . $file->getSize();
	            echo '<br/>';

	            //Lấy kiểu file
	            echo 'Kiểu files: ' . $file->getMimeType();
	            */
    	} else{
    		//người dùng không đổi hình thì để nguyên
    	}
    	$tintuc->save();
    	return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');
    }

    public function getXoa($id){
        $tintuc = TinTuc::find($id);

        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao','Bạn đã xoá thành công');
    }
}
