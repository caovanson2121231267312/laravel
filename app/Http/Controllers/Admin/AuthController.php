<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check()) {
            return redirect()->back();
        }

        return view('admins.auth.login');
    }

    public function login_form(Request $request)
    {
        // dd($request);
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ],
            [
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
                'password.max' => 'Mật khẩu không được vượt quá 30 ký tự.',
            ],
        );

        $credentials = ([
            'email' => $request->email,
            'password' => $request->password,
        ]);


        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.index')->with([
                "success" => "Đăng nhập thành công",
            ]);
        } else {
            return redirect()->route('admin.login')->with([
                'error' => 'Tài khoản hoặc mật khẩu không đúng .',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with(['success' => 'Bạn đã đăng xuất thành công!']);
    }
}
