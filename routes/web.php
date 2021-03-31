<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
	return redirect('home');
});

//Đăng nhập admin
Route::get('admin/dangnhap','UserController@getDangNhapAdmin');
Route::post('admin/dangnhap','UserController@postDangNhapAdmin');

Route::get('/admin', function () {
	return redirect('admin/theloai/danhsach');
});
//Đăng xuất admin
Route::get('admin/logout','UserController@getLogOutAdmin');


/*
tạo nhóm để quản lý admin 1 cách dễ dàng

 */
Route::group(['prefix'=>'/admin','middleware'=>'adminLogin'], function() {//nhóm prefix => các thứ liên quan đến admin sẽ cho voà prefix
	//vì trong mỗi folder có các file con nên tạo thêm 1 group để quản lý
	Route::group(['prefix'=>'theloai'], function() {
	    //admin/theloai/danhsach: để vào danh sách
	    Route::get('/danhsach','TheLoaiController@getDachSach');//
	    //admin/theloai/sua: để vào sửa
	    Route::get('/sua/{id}','TheLoaiController@getSua');
	    Route::post('/sua/{id}','TheLoaiController@postSua');
	    //admin/theloai/them: để vào them
	    Route::get('/them','TheLoaiController@getThem');
	    Route::post('/them','TheLoaiController@postThem');//hàm post nhận dữ liệu về và lưu vào trong cơ sở dữ liệu

	    Route::get('/xoa/{id}','TheLoaiController@getXoa');
	});

	Route::group(['prefix' => 'loaitin'], function() {
	    Route::get('/danhsach','LoaiTinController@getDachSach');//
	    
	    Route::get('/sua/{id}','LoaiTinController@getSua');
	    Route::post('/sua/{id}','LoaiTinController@postSua');
	    
	    Route::get('/them','LoaiTinController@getThem');
	    Route::post('/them','LoaiTinController@postThem');

	    Route::get('/xoa/{id}','LoaiTinController@getXoa');
	});

	Route::group(['prefix' => 'tintuc'], function() {
	    Route::get('/danhsach','TinTucController@getDachSach');//
	    
	    Route::get('/sua/{id}','TinTucController@getSua');
	    Route::post('/sua/{id}','TinTucController@postSua');
	    
	    Route::get('/them','TinTucController@getThem');
	    Route::post('/them','TinTucController@postThem');

	    Route::get('/xoa/{id}','TinTucController@getXoa');
	});
	//Khai báo 1 group ajax để lấy dữ liệu
	Route::group(['prefix' => 'ajax'], function(){
		Route::get('/loaitin/{idTheLoai}','AjaxController@getLoaiTin');
	});

	Route::group(['prefix' => 'comment'], function() {

		Route::get('/xoa/{id}/{idTinTuc}','CommentController@getXoa');
	});
	
	Route::group(['prefix' => 'slide'], function() {
	    Route::get('/danhsach','SlideController@getDachSach');//
	    
	    Route::get('/sua/{id}', [
	    	'as' => 'admin.slide.sua', //as = ten route
	    	'uses' => 'SlideController@getSua',// Controller@phuongthuc
	    	'middleware' => 'auth' //them middles
	    ]);
	    Route::post('/sua/{id}','SlideController@postSua');
	    
	    Route::get('/them','SlideController@getThem');
	    Route::post('/them','SlideController@postThem');

	    Route::get('/xoa/{id}','SlideController@getXoa');
	});


	Route::group(['prefix' => 'user'], function() {
	    Route::get('/danhsach','UserController@getDachSach');//
	    
	    Route::get('/sua/{id}','UserController@getSua');
	    Route::post('/sua/{id}','UserController@postSua');
	    
	    Route::get('/them','UserController@getThem');
	    Route::post('/them','UserController@postThem');

	    Route::get('/xoa/{id}','UserController@getXoa');
	});
});


//Trang front
Route::get('home','PagesController@home');
Route::get('lienhe','PagesController@lienhe');
Route::get('loaitin/{id}/{TenKhongDau}.html','PagesController@loaitin');
Route::get('tintuc/{id}/{TieuDeKhongDau}.html',[
	'as' => 'pages.tintuc',
	'uses' => 'PagesController@tintuc'
]);
Route::post('comment/{id}','CommentController@postComment');
Route::get('nguoidung','PagesController@getNguoiDung');
Route::post('nguoidung','PagesController@postNguoiDung');
Route::get('dangky','PagesController@getDangKy');
Route::post('dangky','PagesController@postDangKy');
//Đăng nhập front
Route::get('dangnhap','PagesController@getDangNhap');
Route::post('dangnhap','PagesController@postDangNhap');
Route::get('gioithieu','PagesController@gioithieu');
Route::get('dangxuat',[
	'as' => 'pages.dangxuat',
	'uses' => 'PagesController@getDangXuat'
]);


//Tìm kiếm
Route::post('/timkiem','PagesController@getTimKiem')->name('page_search');
