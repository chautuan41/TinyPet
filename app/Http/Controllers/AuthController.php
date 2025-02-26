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
            if (Auth::user()->role == 1) {
                return response()->json([
                    'success' => true,
                    'url' => route('admin.index')
                ]);
            } 
            if (Auth::user()->role == 2) {
                return response()->json([
                    'success' => true,
                    'url' => route('user.index')
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
        return redirect()->route('admin.index');
    }
}
