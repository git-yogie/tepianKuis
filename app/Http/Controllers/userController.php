<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function signUp(){
        // return view("");
    }

    public function signIn(Request $request){
        
        $validate = $request->validate([
            "email"=>"required | email",
            "password"=>"required"
        ],
        [
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong'
        ]
        );

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            return response()->json([
                'status' => true,
                'message' => 'Login Berhasil',
                'data' => $user
            ]);

        } else {

            return response()->json([
                'status' => false,
                'message' => 'Email atau Password tidak terdaftar',
                'data' => null
            ]);
        }

    }

    public function imageUpload(){

    }

    public function Authenticate(){
        
    }

}
