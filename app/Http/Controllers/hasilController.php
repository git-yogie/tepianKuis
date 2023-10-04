<?php

namespace App\Http\Controllers;

use App\Models\pesertaQuiz;
use App\Models\Quiz;
use Illuminate\Http\Request;

class hasilController extends Controller
{
    public function daftarKuis()
    {

        $quiz = Quiz::withCount("peserta")->get();

        return view("pages.dashboard.hasil.hasil",compact("quiz"));
    }

    public function daftarPesertaKuis($kode_kuis){
        $peserta_kuis = pesertaQuiz::with("peserta")->where("kuis_code",$kode_kuis)->get();
        
        return view("pages.dashboard.hasil.daftarPeserta",compact("peserta_kuis"));
    }

    public function hasilPeserta($kode_kuis,$id_peserta){
        $peserta_kuis = pesertaQuiz::with("peserta")->where("id",$id_peserta)->get()->first();
        $kuis = Quiz::with("soal")->where("kuis_code",$kode_kuis)->get()->first();

        $hasil = json_decode($peserta_kuis->jawaban_kuis_cbt);
        $soal = json_decode($kuis->soal);
        // dd($peserta_kuis,$kuis,$jawaban,$soal);
        return view("pages.dashboard.hasil.jawabanPeserta",compact(["peserta_kuis","kuis","hasil","soal"]));

    }

    public function api_daftarPesertaKuis($kode_kuis){
        $peserta_kuis = pesertaQuiz::with("peserta")->where("kuis_code",$kode_kuis)->get();
        return response($peserta_kuis,200);
    }
    
}