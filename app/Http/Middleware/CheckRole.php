<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        
        // // Kiểm tra nếu người dùng đã đăng nhập và có vai trò thích hợp
        // if (Auth::check() && Auth::user()->role == 1) {
        //     return redirect()->route('admin.index');
        //     // return view('welcom');
        // }
        
        
        
        
        if (Auth::check()) {
            switch (Auth::user()->role_id) {
                case 2:
                        if ( Auth::user()->role_id != $role) {
                            return redirect()->route('user.index');
                        }
                    break;
                case 3:
                        if ( Auth::user()->role_id != $role) {
                            return redirect()->route('user.index');
                        }
                    break;
                default:
                        
                    break;
            }
              // Nếu có vai trò đúng, tiếp tục yêu cầu
        }
        // Nếu không có quyền, chuyển hướng về trang lỗi hoặc trang khác
        return $next($request);
    }
}
