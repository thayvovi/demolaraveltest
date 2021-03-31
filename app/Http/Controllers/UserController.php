<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Comment;

class UserController extends Controller
{
    public function getDachSach(){
    	$user = User::all();
    	return view('admin.user.danhsach',['user'=>$user]);
    }
    
    public function getThem(){
    	return view('admin.user.them');
    }
    public function postThem(Request $request){
    	$this->validate($request,
    		[
    			'name'=>'required|min:3',
    			'email'=>'required|email|unique:users,email',
    			'password'=>'required|min:8|max:32',
    			'passwordAgain'=>'required|same:password'//với same kiểm tra giống
    		],
    		[
    			'name.required'=>'Bạn chưa nhập tên',
    			'name.mind'=>'Tên phải ít nhất 3 ký tự',
    			'email.required'=>'Bạn chưa nhập email',
    			'email.email'=>'Bạn chưa nhập đúng định dạng',
    			'email.unique'=>'Email đã tồn tại',
    			'password.required'=>'Bạn chưa nhập mật khẩu',
    			'password.min'=>'Độ dài mật khẩu phải ít nhất 8 ký tự',
    			'password.max'=>'Độ dài mật khẩu nhiều nhất 32 ký tự',
    			'passwordAgain.required'=>'Bạn hãy nhập lại mật khẩu',
    			'passwordAgain.same'=>"Mật khẩu nhập lại không khớp với mật khẩu"
    		]
    	);

    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);//bcrypt = md5 dùng để mã hoá mật khẩu
    	$user->quyen = $request->quyen;

    	$user->save();
    	return redirect('admin/user/them')->with("thongbao","Thêm thành công");
    }
    
    public function getSua($id){
    	$user = User::find($id);
    	return view('admin.user.sua',['user'=>$user]);
    }
    public function postSua(Request $request,$id){
    	
    	$this->validate($request,
    		[
    			'name'=>'required|min:3'
    		],
    		[
    			'name.required'=>'Bạn chưa nhập tên',
    			'name.mind'=>'Tên phải ít nhất 3 ký tự',
    		]
    	);
    	$user = User::find($id);
    	$user->name = $request->name;
    	$user->quyen = $request->quyen;

    	if ($request->changePassWord == "on") {
    		$this->validate($request,
	    		[
	    			'password'=>'required|min:8|max:32',
	    			'passwordAgain'=>'required|same:password'//với same kiểm tra giống
	    		],
	    		[
	    			'password.required'=>'Bạn chưa nhập mật khẩu',
	    			'password.min'=>'Độ dài mật khẩu phải ít nhất 8 ký tự',
	    			'password.max'=>'Độ dài mật khẩu nhiều nhất 32 ký tự',
	    			'passwordAgain.required'=>'Bạn hãy nhập lại mật khẩu',
	    			'passwordAgain.same'=>"Mật khẩu nhập lại không khớp với mật khẩu"
	    		]
	    	);
    		$user->password = bcrypt($request->password);
    		
    	}
    	$user->save();
    	return redirect('admin/user/sua/'.$id)->with("thongbao","Sửa thành công");
    }

    public function getXoa($id){
    	$user = User::find($id);

        $user->delete();

        return redirect('admin/user/danhsach')->with('thongbao','Bạn đã xoá thành công');
    }


    //Đăng nhập
    public function getDangNhapAdmin(){
    	return view('admin.login');
    }
    public function postDangNhapAdmin(Request $request){
    	$this->validate($request,
    		[
    			'email'=>'required',
    			'password'=>'required|min:8|max:32',
    		],
    		[
    			'email.required'=>'Bạn chưa nhập email',
    			'password.required'=>'Bạn chưa nhập mật khẩu',
    			'password.min'=>'Mật khẩu hoặc tài khoản sai ',
    			'password.max'=>'Mật khẩu hoặc tài khoản sai',
    		]
    	);
    	if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
    		return redirect('admin/theloai/danhsach');
    	}
    	else{
    		return redirect('admin/dangnhap')->with("thongbao","Đăng nhập không thành công");
    	}
    }

    public function getLogOutAdmin(){
    	Auth::logout();
    	return redirect('admin/dangnhap');
    }
}
