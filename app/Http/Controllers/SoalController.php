<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Soal;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($kuis_code)
    {
        $kuis = Quiz::where("kuis_code",$kuis_code)->first();
        $data = Soal::where("id_kuis",$kuis->id)->get();
        

        return response(["data"=>$data],200);
        
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
        $var = json_encode($request->all());
        
        $kuis = Quiz::where("kuis_code",$request->kuis_code)->first();

        $Soal = new Soal;
        $Soal->judul_soal  = $request->judul;
        $Soal->poin = $request->poin;
        $Soal->soal_data = json_encode($request->data);
        $Soal->id_kuis = $kuis->id;
        $Soal->jenis_soal = $request->jenis_kuis;
        $Soal->save();
        

        return response(["message"=>"tersimpan","id_soal"=>$Soal->id],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $soal = Soal::where("id",$id)->first();
        return response(["data"=>$soal],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Soal $soal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        $Soal = Soal::find($id);
        $Soal->judul_soal  = $request->judul;
        $Soal->poin = $request->poin;
        $Soal->soal_data = json_encode($request->data);
        $Soal->save();

        return response(["message"=>"tersimpan"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Soal $soal)
    {
        //
    }
}
