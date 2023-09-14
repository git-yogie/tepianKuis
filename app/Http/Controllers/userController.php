<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class userController extends Controller
{
    public function signUp(Request $request){
        $validate = $request->validate([
            "namaDaftar"=>"required",
            "emailDaftar"=>"required | email |unique:users,email",
            "passwordDaftar"=>"required",
            "konfirmasiPassword"=>"required | same:passwordDaftar"
        ],
        [
            'emailDaftar.unique'=> "email sudah terdaftar!",
            'namaDaftar.required' => 'Nama tidak boleh kosong',
            'emailDaftar.required' => 'Email tidak boleh kosong',
            'passwordDaftar.required' => 'Password tidak boleh kosong',
            "konfirmasiPassword.same"=>"Masukan password yang sama!"
        ]
        );

        $user = new User;
        $user->nama = $request->namaDaftar;
        $user->email = $request->emailDaftar;
        do {
            $randomString = Str::random(32);
        } while (User::where('api_key', $randomString)->exists());
        $user->api_key = $randomString;
        $user->password =   bcrypt($request->passwordDaftar);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Register Berhasil',
            'data' => $user
        ]);
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
