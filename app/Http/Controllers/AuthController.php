<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    
   
    public function loginWithFirebase(Request $request)
    {
        $firebase = app('firebase.auth');
          
        try {
        // ✅ Lấy ID token từ phía frontend (JS Firebase)
        $idToken = $request->input('id_token');
        
        if (!$idToken) {
            return response()->json(['error' => 'Thiếu ID token'], 400);
        }
        
        // ✅ Xác minh ID token
        $verifiedIdToken = $firebase->verifyIdToken($idToken);
        
        $uid = $verifiedIdToken->claims()->get('sub');

        // ✅ Tìm user theo Firebase UID
        $user = User::where('firebase_uid', $uid)->first();

        if (!$user) {
            // ✅ Lấy thông tin người dùng từ Firebase
            $firebaseUser = $firebase->getUser($uid);

            $user = User::create([
                'name' => $firebaseUser->displayName ?? 'No Name',
                'email' => $firebaseUser->email ?? ($uid . '@firebase.local'),
                'firebase_uid' => $uid,
                'role_id' => 3, // 👈 tuỳ theo hệ thống của bạn
                'status' => 1,
                'password' => bcrypt(str()->random(16)), // 👈 mật khẩu ngẫu nhiên
            ]);
        }

        
        // ✅ Đăng nhập vào hệ thống Laravel
        Auth::login($user);

        return response()->json([
            'url' => route('user.index'),
            'message' => 'Đăng nhập thành công!',
            'user' => $user
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'error' => 'Xác thực thất bại: ' . $e->getMessage()
        ], 401);
    }
    }

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
