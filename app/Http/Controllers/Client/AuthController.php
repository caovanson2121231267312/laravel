<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;
use Faker\Extension\Extension;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup()
    {
        return view('client.auth.signup');
    }

    public function sign(SignupRequest $request)
    {

        try {
            $email = $request->email;
            $data = User::where('email', $email)->first();
            if (!empty($data)) {
                return redirect()->route('signup')->with([
                    'error' => "đã tồn tại email: " . $email,
                ]);
            } else {
                $data = User::create([
                    'name' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $role = Role::find(8);

                $data->assignRole([$role->name]);

                Auth::login($data, $remember = true);

                return redirect()->route('home')->with([
                    'success' => 'Đăng kí thành công'
                ]);
            }
        } catch (Extension $e) {
            return redirect()->back()->with([
                'error' => $e,
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with(['success' => 'Bạn đã đăng xuất thành công!']);
    }

    public function login()
    {
        return view('client.auth.login');
    }

    public function login_client(Request $request)
    {
        // $account=([])
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home')->with([
                'success' => 'Đăng nhập thành công '
            ]);
        } else {
            return redirect()->route('login')->with([
                'error' => 'Thông tin đăng nhập không chinh xác'
            ]);
        }
    }
}
