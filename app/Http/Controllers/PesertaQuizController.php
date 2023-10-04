<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\pesertaQuiz;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($kode_kuis)
    {
        $data["peserta"] = Peserta::whereHas("pesertaQuiz", function($query) use ($kode_kuis) {
            $query->where("kuis_code", $kode_kuis);
        }, "=", 0)
        ->where("id_users", Auth::user()->id)
        ->get();
    
        $data["peserta_quiz"] = pesertaQuiz::with("peserta")->where("id_user", Auth::user()->id)->where("kuis_code",$kode_kuis)->get();
        
        return $data;
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    public function savePesertaAnswer(Request $request,$id){
        
        $peserta = pesertaQuiz::find($id);           

        $peserta->jawaban_kuis_cbt = $request->result;
        $peserta->save();

        return  response(["message"=>"berhasil",201]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $idKuis = Quiz::where("kuis_code",$request->kode_kuis)->first();
        $ids = $request->input("ids");
        $id_user = Auth::user()->id;

        $peserta = [];
        foreach ($ids as $id) {
            $peserta[] = [
                "id_peserta" => $id,
                "id_kuis" => $idKuis->id,
                "id_user" => $id_user,
                "kuis_code" => $request->kode_kuis,
                'jawaban_kuis_cbt'=>"{}",
                "jawaban_kuis_embed"=>"{}"
            ];
        }
        pesertaQuiz::insert($peserta);
        return response(["message"=>"berhasil",201]);
    }

    /**
     * Display the specified resource.
     */
    public function show(pesertaQuiz $pesertaQuiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pesertaQuiz $pesertaQuiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pesertaQuiz $pesertaQuiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $idsToRemove = $request->input("ids");

        $peserta = pesertaQuiz::whereIn('id',$idsToRemove)->delete();
        return response(["message"=>"berhasil"],200);
        // $peserta = pesertaQuiz::find($id);
        // if(!$peserta){
        //     return response()->json(['message' => 'Peserta not found'], 404);
        // }
        // $peserta->delete();
        // return response(["message"=>"Di hapus"],204);
    }

    public function getResult($id,$kode_kuis){
        $pesertaQuiz = pesertaQuiz::find($id)->where("kuis_code",$kode_kuis)->get()->first();
        return response($pesertaQuiz,200);
    }   

    public function api_getHasilQuiz($kode_kuis){
        $pesertaQuiz = pesertaQuiz::where("kuis_code",$kode_kuis)->get();
        return response($pesertaQuiz,200);
    }
}
