<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class auth_controller extends Controller
{
    public function index()
    {
        return view("admin.auth.authentication");
    }

    public function authenticate(Request $request)
    {

        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                "username.required" => "Username tidak boleh kosong",
                "password.required" => "Password tidak boleh kosong",
            ]
        );


        $credentials = $request->only('username', 'password');

        if(Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();
            // dd(Auth::guard("admin")->User());    
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'notAuthenticate' => 'Username atau password salah',
        ]);


    }

    public function signOut(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
