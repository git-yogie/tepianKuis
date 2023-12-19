<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\User;
use App\Models\apiLog;
use App\Models\Peserta;
use App\Models\PesertaQuiz;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class adminApiResource extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getThreeDayLog()
    {
        $data = [];
        for ($i = 0; $i < 7; $i++) {
            $date = date("Y-m-d D", strtotime("-$i days"));
            $count = apiLog::whereDate("created_at", $date)->count();
            $data[$date] = $count;
        }

        $data = array_reverse($data);
        return response()->json($data);
    }

    public function getUser()
    {

        $data = User::all();
        // return the json of users
        return response()->json($data);
    }

    public function getUserById($id){
        $data = User::where("id", $id)->first();
        return response()->json($data);
    }

    public function addUser(Request $request)
    {
        $validate = $request->validate(
            [
                "nama" => "required",
                "email" => "required | email |unique:users,email",
                "password" => "required",
            ],
            [
                'email.unique' => "email sudah terdaftar!",
                'nama.required' => 'Nama tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'password.required' => 'Password tidak boleh kosong',
            ]
        );

        $user = new User;
        $user->nama = $request->nama;
        $user->email = $request->email;

        do {
            $randomString = Str::random(32);
        } while (User::where('api_key', $randomString)->exists());

        $user->api_key = $randomString;
        $user->password =   bcrypt($request->password);
        $user->save();

        return response(["message"=>"Berhasil"],201);
    }
    public function userUpdate(Request $request, $id){
        $validate = $request->validate(
            [
                "nama" => "required",
                "email" => "required|email|unique:users,email," . $id,
            ],
            [
                'email.unique' => "email sudah terdaftar!",
                'nama.required' => 'Nama tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
            ]
        );

        $user = User::where("id", $id)->first();
        $user->nama = $request->nama;
        $user->email = $request->email;
        if($request->password != null){
            $user->password =   bcrypt($request->password);
        }
        $user->save();

        return response(["message"=>"Berhasil"],201);
    }

    public function userDestroy($id){
        $user = User::where("id", $id)->first();
        // $quiz = Quiz::where("user_id", $id)->delete();
        // $peserta = Peserta::where("id_users", $id)->delete();
        // $pesertaQuiz = PesertaQuiz::where("id_peserta", $id)->delete();
        $user->delete();
        return response(["message"=>"Berhasil"],201);
    }
    public function userLogin($id){
        $user = User::find($id);
        if($user){
            Auth::loginUsingId($user->id);
            return response(["message"=>"Berhasil"],201);
        }else{
            return response(["message"=>"Gagal"],201);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
