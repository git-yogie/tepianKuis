<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function signUp(Request $request){
        // $validate = $request->validate([
        //     "name"=>"required",
        //     "email"=>"required | email",
        //     "password"=>"required"
        // ],
        // [
        //     'name.required' => 'Nama tidak boleh kosong',
        //     'email.required' => 'Email tidak boleh kosong',
        //     'password.required' => 'Password tidak boleh kosong'
        // ]
        // );

        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;

        // $user->password = Hash::make($request->password);
        // $user->save();

        // return response()->json([
        //     'status' => true,
        //     'message' => 'Register Berhasil',
        //     'data' => $user
        // ]);

        return response()->json($request);
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
