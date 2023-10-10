<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Peserta;
use App\Models\pesertaQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class quizApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $quiz)
    {
        $user = $request->attributes->get("valid_user");
        $quiz = Quiz::with("soal")->where("user_id", $user->id)->where("kuis_code", $quiz)->first();
        if ($quiz) {
            return response($quiz, 200);
        } else {
            return response(["message"=>"Tidak ditemukan"], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function saveAnswer($kuis_code, Request $request)
    {
        
        $peserta = Peserta::where("email",$request->peserta["email"])
        ->where("nis",$request->peserta["nis"])
        ->where("id_users",Auth::user()->id)
        ->first();
        $kuis = Quiz::where("kuis_code",$kuis_code)->where("user_id",Auth::user()->id)->first();

        $pesertaQuiz = pesertaQuiz::where("id_peserta",$peserta->id)
        ->where("id_kuis",$kuis->id)->first();

        $savior = pesertaQuiz::find($pesertaQuiz->id);
        $savior->jawaban_kuis_embed = $request->jawaban;
        $savior->save();

        return response([$pesertaQuiz]);
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