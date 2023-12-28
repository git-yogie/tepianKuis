<?php

namespace App\Http\Controllers;

use App\Exports\rekapExport;
use App\Models\Quiz;
use App\Models\Soal;
use App\Models\pesertaQuiz;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class QuizController extends Controller
{
    function __construct()
    {
        $this->middleware("auth")->only(["protectedMethod"]);
    }
    /**
     * Display a listing of the resource.
     */
    protected function index()
    {
        $var = Quiz::withCount('soal')
            ->withCount("peserta")
            ->where("user_id", Auth::user()->id)->latest()->get();
        return response($var, 200);
    }


    protected function quizPage($code)
    {
        $var = Quiz::where("user_id", Auth::user()->id)->where("kuis_code", $code)->get();

        return view("pages.dashboard.kuis_detail", ['var' => $var]);
    }

    protected function quizEditor($jenis, $code, $id_soal = null)
    {

        $data = [];
        $data['var'] = Quiz::where("user_id", Auth::user()->id)->where("kuis_code", $code)->get();
        if ($id_soal != null) {
            $data["soal"] = Soal::where("id", $id_soal)->first();
        }
        $view = '';
        switch ($jenis) {
            case 'pilihanGanda':
                $view = view("pages.dashboard.kuis_editor.editor.pilihan_ganda", $data);
                break;
            case 'isianSingkat';
                $view = view("pages.dashboard.kuis_editor.editor.isian_singkat", $data);
            default:

                break;
        }

        return $view;

    }



    protected function bannerHandler(Request $request)
    {
        $path = 'files/';
        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777, true);
        }
        $file = $request->file('avatar');
        $new_image_name = 'UIMG' . date('Ymd') . uniqid() . '.jpg';
        $upload = $file->move(public_path($path), $new_image_name);
        if ($upload) {
            return response()->json(['status' => 1, 'msg' => $new_image_name, 'name' => $new_image_name]);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getConfig($id)
    {

        $var = Quiz::find($id);
        return response($var->konfigurasi, 200);

    }

    public function pruneFile()
    {

        $banner = Quiz::pluck("banner")->toArray();

        $path = public_path("/files");
        $files = File::allFiles($path);
        foreach ($files as $file) {
            $filePath = $file->getPathname();

            if (!in_array($file->getFilename(), $banner)) {
                File::delete($filePath);
            }
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    protected function store(Request $request)
    {

        $request->validate(
            [
                "judul_kuis" => "required",
                "mata_pelajaran" => "required",
                "tingkatan" => "required"
            ],
            [
                "judul_kuis.required" => "Judul kuis harus diisi",
                "mata_pelajaran.required" => "Pilih mata pelajaran",
                "tingkatan.required" => "Pilih tingkatan"
            ]
        );

        // $request->validate()
        do {
            $randomString = Str::random(4);
        } while (Quiz::where('kuis_code', $randomString)->exists());

        // -------------------------------------->| Don't Touch
        $quiz = new Quiz();
        $quiz->kuis_code = $randomString;
        $quiz->nama = $request->judul_kuis;
        $quiz->mata_pelajaran = $request->mata_pelajaran;
        $quiz->tingkatan = $request->tingkatan;
        $quiz->user_id = Auth::user()->id;
        $quiz->konfigurasi = "{}";
        // --------------------------------------->| Don't Touch

        if ($request->file_name != null) {
            $quiz->banner = $request->file_name;
        }
        $quiz->save();
        $this->pruneFile();
        return response($request, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($kode_kuis)
    {
        $quiz = Quiz::where('kuis_code', $kode_kuis)->first();
        return response($quiz, 200);
    }

    public function dowhloadQuiz($kode_kuis)
    {
        $quiz = Quiz::where('kuis_code', $kode_kuis)->first();
        $soal = Soal::where("id_kuis",$quiz->id)->get();

        $response = Response::make(json_encode($soal));

        $response->header('Content-Type', 'application/json');
        $response->header('Content-Disposition', 'attachment; filename='.$quiz->nama.'.json');
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                "judul_kuis" => "required",
                "mata_pelajaran" => "required",
                "tingkatan" => "required"
            ],
            [
                "judul_kuis.required" => "Judul kuis harus diisi",
                "mata_pelajaran.required" => "Pilih mata pelajaran",
                "tingkatan.required" => "Pilih tingkatan"
            ]
        );
        // dd($request->all(),$request->judul_kuis);
        $quiz = Quiz::find($request->id);
        $quiz->nama = $request->judul_kuis;
        $quiz->mata_pelajaran = $request->mata_pelajaran;
        $quiz->tingkatan = $request->tingkatan;
        if ($request->file_name != null) {
            $quiz->banner = $request->file_name;
        }
        $quiz->save();
        $this->pruneFile();
        return response($request, 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        //
    }

    public function updateConfig($id, Request $request)
    {
        try {
            $quiz = Quiz::find($id);
            $quiz->konfigurasi = json_encode($request->all());

            $quiz->save();
            return response(["message" => "konfigurasi di update"], 200);
        } catch (\Exception $e) {
            return response(["message" => $e->getMessage()], 500);
        }
    }

    public function pruneSoal(){
        return Excel::download(new rekapExport("2ZlM"), 'users.xlsx');
        // $soal = pesertaQuiz::all();
        // foreach ($soal as $key => $value) {
        //     if($value->jawaban_kuis_cbt == "{}"){
        //         echo "gak ada jawaban kuis ".$value->id." ❌ <br> ";
        //         continue;
        //     }
        //     $data = json_decode($value->jawaban_kuis_cbt);
        //     foreach ($data->jawaban_user as $jawaban) {
        //         unset($jawaban->soal);
        //         // unset($jawaban->data->soal_data);
        //         // unset($jawaban->data->judul_soal);
        //         // unset($jawaban->data->created_at);
        //         // unset($jawaban->data->updated_at);
        //     }
        //     $value->jawaban_kuis_cbt = json_encode($data);
        //     $value->save();
        //     echo "berhasil di update peserta ke ".$value->id." ✅<br> ";
        // }

        // // $data = json_decode($soal[50]->jawaban_kuis_cbt);
        // // dd($data);
    }

}
