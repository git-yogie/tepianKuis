<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peserta = Peserta::where("id_users",Auth::user()->id)->get()->makeHidden("id_users");
        return response($peserta,200);
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

        $request->validate([
            "nama"=>"required",
            "nis"=>"required | unique:pesertas,nis",
            "email"=>"required |email| unique:pesertas,email",
            "kelas"=>"required",
        ],
        [
            
            "nama.required"=>"nama tidak boleh kosong",
            "nis.required"=>"nis tidak boleh kosong",
            "email.required"=>"email tidak boleh kosong",
            "email.email"=>"email tidak valid",
            "kelas.required"=>"kelas tidak boleh kosong",
            "nis.unique"=>"NISN ini sudah dimiliki oleh peserta lain.",
            "email.unique"=>"email ini sudah dimiliki oleh peserta lain"

        ]);

        $peserta = new Peserta();
        $peserta->nama = $request->nama;
        $peserta->nis = $request->nis;
        $peserta->email = $request->email;
        $peserta->kelas = $request->kelas;
        $peserta->id_users = Auth::user()->id;
        $peserta->save();


        return response(["message"=>"Data peserta berhasil ditambahkan!"],201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $peserta = Peserta::find($id);
        if (!$peserta) {
            return response()->json(['message' => 'Peserta not found'], 404);
        }
        return response($peserta,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peserta $peserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
    
        $request->validate([
            "nama"=>"required",
            "nis"=>"required",
            "email"=>"required | email ",
            "kelas"=>"required",
        ],
        [
            "nama.required"=>"nama tidak boleh kosong",
            "nis.required"=>"nis tidak boleh kosong",
            "email.required"=>"email tidak boleh kosong",
            "email.email"=>"email tidak valid",
            "kelas.required"=>"kelas tidak boleh kosong",
            "unique" => "Email sudah ada pada peserta lainnya"
        ]);

        $peserta = Peserta::find($id);
        $peserta->nama = $request->nama;
        $peserta->nis = $request->nis;
        $peserta->email = $request->email;
        $peserta->kelas = $request->kelas;
        $peserta->save();

        return response(["message"=>"di hapus"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $peserta = Peserta::find($id);
        if (!$peserta) {
            return response()->json(['message' => 'Peserta not found'], 404);
        }
        $peserta->delete();
        return response(["message"=>"Di hapus"],204);
    }

    public function api_getPeserta(){
        $peserta = Peserta::where("id_users", Auth::user())->get();
        return response($peserta,200);
    }
    

    
}
