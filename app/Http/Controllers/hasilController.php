<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\pesertaQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function hasilPeserta($type,$kode_kuis,$id_peserta){
        $peserta_kuis = pesertaQuiz::with("peserta")->
        where("id",$id_peserta)
        ->where("id_user",Auth::user()->id)
        ->get()->first();
        $kuis = Quiz::with("soal")->where("kuis_code",$kode_kuis)->get()->first();

        if($type == "embed"){
            $hasil = json_decode($peserta_kuis->jawaban_kuis_embed);
        }else{
            $hasil = json_decode($peserta_kuis->jawaban_kuis_cbt);
        }
        $soal = json_decode($kuis->soal);
        // dd($hasil,$soal);
        // dd($peserta_kuis,$kuis,$jawaban,$soal);
        return view("pages.dashboard.hasil.jawabanPeserta",compact(["peserta_kuis","kuis","hasil","soal"]));

    }

    public function api_daftarPesertaKuis($kode_kuis){
        $peserta_kuis = pesertaQuiz::with("peserta")->where("kuis_code",$kode_kuis)->get();
        
        return response($peserta_kuis,200);
    }
    
}