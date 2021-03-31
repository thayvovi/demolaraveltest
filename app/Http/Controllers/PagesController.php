<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;//view::share

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Models\TheLoai;

use App\Models\LoaiTin;

use App\Models\TinTuc;

use App\Models\Comment;

use App\Models\User;

use App\Models\Slide;

class PagesController extends Controller
{
	public function __construct(){
		$theloai = TheLoai::all();
		$slide = Slide::all();
		view()->share('theloai',$theloai);//Truyền lên view 1 biến thể loại và tự đồng truyền cho các fun sau
        view()->share('slide',$slide);
		// view::share(['theloai'=>$theloai],['slide'=>$slide]);
	}

    public function home(){
    	
    	return view('pages.home');
    }

    function lienhe(){
    	
    	return view('pages.lienhe');
    }
    function gioithieu(){
        
        return view('pages.gioithieu');
    }
    function loaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);//với paginate là hàm phân trang của laravel
        return view('pages.loaitin',['loaitin'=>$loaitin],['tintuc'=>$tintuc]);
    }
    function tintuc($id){
        $tintuc = TinTuc::find($id);
        $tinnb = TinTuc::where('NoiBat',1)->take(5)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(5)->get();
        $luotxem = DB::table('tintuc')->where('id', $id)->update(['SoLuotXem' => $tintuc->SoLuotXem+1]);
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnb'=>$tinnb,'tinlienquan'=>$tinlienquan,'luotxem'=>$luotxem]);
    }

    public function getDangNhap(){
        return view('pages.dangnhap');
    }
    public function postDangNhap(Request $request){
        /* test trước
        // echo $request->email.'<br>';
        // echo $request->password;
        */
       
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
            return redirect()->intended('/');
        }
        else{
            return redirect('dangnhap')->with("thongbao","Đăng nhập không thành công");
        }
    }

    public function getDangXuat()
    {
        Auth::logout();
        return redirect('home');
    }

    public function getNguoiDung()
    {
        return view('pages.nguoidung',);
    }
    public function postNguoiDung(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required|min:3'
            ],
            [
                'name.required'=>'Bạn chưa nhập tên',
                'name.mind'=>'Tên phải ít nhất 3 ký tự',
            ]
        );
        $user = Auth::user();
        $user->name = $request->name;

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
        return redirect('nguoidung')->with("thongbao","Thay đổi thông tin thành công!");
    }

    public function getDangKy()
    {
        return view('pages.dangky');
    }
    public function postDangKy(Request $request)
    {
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
        $user->quyen = 0;

        $user->save();
        auth()->login($user);

        return redirect()->intended('/');//
        //return redirect('dangky')->with("thongbao","Tạo tài khoản thành công");
    }
    public function getTimKiem(Request $request)
    {
        $tukhoa = $request->tukhoa;
        $tintuc = TinTuc::where('TieuDe','like',"%{$tukhoa}%")
                    ->orWhere('TomTat','like',"%{$tukhoa}%")
                    ->orWhere('NoiDung','like',"%{$tukhoa}%")
                    ->take(30)
                    ->paginate(5);
        return view('pages.timkiem',['tukhoa'=>$tukhoa,'tintuc'=>$tintuc]);//tìm kiếm xong sẽ truyền tin tức đồng thời truyền từ khoá tìm kiếm
    }
}
