<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Slide;
class SlideController extends Controller
{
    public function getDachSach(){
    	$slide = Slide::all();
    	return view('admin.slide.danhsach',['slide'=>$slide]);
    }

    public function getThem(){
    	return view('admin.slide.them');
    }
    public function postThem(Request $request){
    	$this->validate($request,
    		[
    			'Ten'=>'required',
    			'NoiDung'=>'required'
    		],
    		[
    			'Ten.required'=>'Bạn chưa nhập tên',
    			'NoiDung.required'=>'Bạn chưa nhập nội dung'
    		]
    	);

    	$slide = new Slide;
    	$slide->Ten =$request->Ten;
    	$slide->NoiDung = $request->NoiDung;

    	if ($request->has('link'))
    		$slide->link = $request->link;
    	
    	if ($request->hasFile('Hinh')) {//Kiểm tra xem có hình truyền lên không
    		
    		$file = $request->file('Hinh');//lưu hình vào biến file
    		$duoi = $file->getClientOriginalExtension();
    		if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'gif' && $duoi != 'jpeg') {
    			return redirect('admin/tintuc/them')->with('loi','File của bạn phải có định dạng jpg,png,gif,jpge');
    		}
    		$name = $file->getClientOriginalName();//lấy tên hình
    		$Hinh = str::random(4)."_".$name;
    		//echo $Hinh;//test thử xem đặt tên thế nào trước đó phải bỏ $bien->save() để không lưu
    		while (file_exists("upload/slide/".$Hinh)) {//kiểm tra tồn tại chưa nếu trùng thì lặp cho đến khi không bị trùng
    		    $Hinh = str::random(4)."_".$name;//với hinh bảng tên người dùng đặt và trước tên gốc là ký tự random
    		}
    		
    		$file->move('upload/slide/',$Hinh);//lưu hình
    		
    		$slide->Hinh = $Hinh;
    	} else{
    		$slide->Hinh = "";
    	}
    	$slide->save();
    	return redirect('admin/slide/them')->with('thongbao','Bạn đã thêm thành công');
    }

    public function getSua($id){
    	$slide = Slide::find($id);
    	return view('admin.slide.sua',['slide'=>$slide]);
    }
    public function postSua(Request $request,$id){
    	$slide = Slide::find($id);
    	$this->validate($request,
    		[
    			'Ten'=>'required',
    			'NoiDung'=>'required'
    		],
    		[
    			'Ten.required'=>'Bạn chưa nhập tên',
    			'NoiDung.required'=>'Bạn chưa nhập nội dung'
    		]
    	);

    	$slide->Ten =$request->Ten;
    	$slide->NoiDung = $request->NoiDung;

    	if ($request->has('link'))
    		$slide->link = $request->link;
    	
    	if ($request->hasFile('Hinh')) {//Kiểm tra xem có hình truyền lên không
    		
    		$file = $request->file('Hinh');//lưu hình vào biến file
    		$duoi = $file->getClientOriginalExtension();
    		if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'gif' && $duoi != 'jpeg') {
    			return redirect('admin/tintuc/them')->with('loi','File của bạn phải có định dạng jpg,png,gif,jpge');
    		}
    		$name = $file->getClientOriginalName();//lấy tên hình
    		$Hinh = str::random(4)."_".$name;
    		//echo $Hinh;//test thử xem đặt tên thế nào trước đó phải bỏ $bien->save() để không lưu
    		while (file_exists("upload/slide/".$Hinh)) {//kiểm tra tồn tại chưa nếu trùng thì lặp cho đến khi không bị trùng
    		    $Hinh = str::random(4)."_".$name;//với hinh bảng tên người dùng đặt và trước tên gốc là ký tự random
    		}
    		
    		$file->move('upload/slide/',$Hinh);//lưu hình
    		unlink("upload/slide/".$slide->Hinh);//Xoá hình cũ
    		$slide->Hinh = $Hinh;
    	} else{
    		$slide->Hinh = "";
    	}
    	$slide->save();
    	return redirect('admin/slide/sua/'.$id)->with('thongbao','Bạn đã thêm thành công');
    }
    public function getXoa($id){
    	 $slide = slide::find($id);
        $slide->delete();

        return redirect('admin/slide/danhsach')->with('thongbao','Bạn đã xoá thành công');
    }
}