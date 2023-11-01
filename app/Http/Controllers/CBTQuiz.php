<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Peserta;
use App\Models\pesertaQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CBTQuiz extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        return view("CBT.pages.quiz");
    }

    public function login()
    {

        return view("CBT.auth.auth");
    }

    public function authPeserta(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|email',
            'nis' => 'required|string',
            'kode-kuis' => 'required|string',
        ]);

        $peserta = Peserta::where("email", $request->input("email"))
            ->where("nis", $request->input("nis"));

        $kuis = Quiz::where("kuis_code", $request->input("kode-kuis"));
        $konfigurasi = Json_decode($kuis->first()->konfigurasi);
        $waktu_mulai = Carbon::parse($konfigurasi->waktu_mulai);
        $waktu_selesai = Carbon::parse($konfigurasi->waktu_berakhir);
        $waktu_sekarang = Carbon::now();
        if ($waktu_sekarang->greaterThan($waktu_selesai)) {
            return redirect()->back()->with("error", "Waktu mengerjakan kuis sudah lewat!");
        } else if (!$waktu_sekarang->between($waktu_mulai, $waktu_selesai)) {
            return redirect()->back()->with("error", "Belum masuk waktu mengerjakan kuis!");
        }
        if ($kuis->exists() && $peserta->exists()) {
            $peserta_kuis = pesertaQuiz::where("id_kuis", $kuis->first()->id)->where("id_peserta", $peserta->first()->id);
            if ($peserta_kuis->exists()) {
                session([
                    "peserta_kuis" => [

                        "id" => $peserta->first()->id,
                        "kode_kuis" => $request->input("kode-kuis"),
                        "id_peserta" => $peserta_kuis->first()->id,
                        "nama" => $peserta->first()->nama,
                        "nis" => $peserta->first()->nis,
                        "email" => $peserta->first()->email,
                        "kelas" => $peserta->first()->kelas
                    ]
                ]);

                return redirect()->route("cbt", $request->input("kode-kuis"));
            } else {
                return redirect()->back()->with("error", "Email, nis atau kode kuis anda tidak terdaftar!");
            }
        } else {
            return redirect()->back()->with("error", "Email, nis atau kode kuis anda tidak terdaftar!");
        }



    }

    public function result($quiz, $peserta)
    {

    }

    public function forgetPeserta()
    {
        session()->forget("peserta_kuis");
        return redirect()->route("cbt.login");
    }

    public function saveQuiz()
    {

    }

    // public function authenticate(Request $request){
    //     $request->validate([
    //         "email"=>"email | required",
    //         "nis" =>"numeric | required",
    //         "kode_kuis"=>"required"
    //     ])

    //     return $request
    // }

    public function hasil($kode_kuis, $id_peserta)
    {
        // if(Session::has("")){

        // }
        $pesertaQuiz = pesertaQuiz::where("kuis_code", $kode_kuis)->find($id_peserta);
        $quiz = Quiz::with("soal")->where("kuis_code", $kode_kuis)->get()->first();
        $parseResult = json_decode($pesertaQuiz->jawaban_kuis_cbt);
        $parseKonfigurasi = json_decode($quiz->konfigurasi);
        return view("CBT.pages.hasilQuiz", compact(["quiz", "parseResult", "parseKonfigurasi"]));

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