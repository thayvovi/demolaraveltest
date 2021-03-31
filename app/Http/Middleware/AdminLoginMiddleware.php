<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();//lưu thông tin vào biến user
            if (Auth::user()->quyen == 1) {//nếu là admin thì đăng nhập
                return $next($request);
            } else{//Ngược lại
                return redirect("admin/dangnhap");
            }
            
        }
        else{
            return redirect("admin/dangnhap");
        }
    }
}
