<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
   

    public function showLogin()
    {
        
        return view('auth.login');
    }

    public function login(Request $request)
    {
        
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        
        if (Auth::attempt($validated)) {
            if(Auth::user()->status == 1){
                //ADMIN
                if (Auth::user()->role_id == 1) {
                    return response()->json([
                        'success' => true,
                        'url' => route('admin.index')
                    ]);
                }
                //NHÂN VIÊN
                if (Auth::user()->role_id == 2) {
                    return response()->json([
                        'success' => true,
                        'url' => route('staff.index')
                    ]);
                }
                //KHÁCH HÀNG
                if (Auth::user()->role_id == 3) {
                    return response()->json([
                        'success' => true,
                        'url' => route('user.index')
                    ]);
                }
            }else {
                Auth::logout();
                return response()->json([
                    'success' => false, 
                    'mess' => "Tài khoản của bạn đã bị khóa",
                ]);
            }
        }else {
            return response()->json([
                'success' => false, 
                'mess' => "Tài khoản hoặc mật khẩu của bạn chưa chính xác",
            ]);
        }

        // return response()->json([
        //     'success' => false, 
        //     'mess' => "Tài khoản hoặc mật khẩu của bạn chưa chính xác",
        // ]);
        
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.index');
    }
}
