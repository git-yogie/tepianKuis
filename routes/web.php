<?php

use App\Http\Controllers\CBTQuiz;
use App\Http\Controllers\hasilController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|Aturan penamaan Route 
|------------------------------------------------------------------------------
|{pastikan bahwa route seperti dashboard/profil di beri nama dashboard.profile}
|penggunaan tanda titik mempengaruhi pengaktifan menu.
*/

Route::middleware(['auth'])->group(function () {
    Route::controller(dashboard::class)->group(function () {
        Route::get("/dashboard", "index")->name("dashboard");
    });

    Route::controller(userController::class)->group(function () {
        Route::post("/dashboard/profile/update/","updateUser")->name("dashboard.profile.update");
        Route::get("/dashboard/logout", "signOut")->name("dashboard.logout")->middleware('auth');
        Route::get("/dashboard/refreshtoken/{id}", "refreshToken")->name("dashboard.refreshtoken");
    });
    
Route::prefix('doc')->group(function () {
    Route::get("/get-started",function(){ return view("documentation.get-started");})->name("doc.get-started");
});

   

    // dashboard -> pustaka kuis
// ------------------------------ dev Area ------------------------------------
    Route::get("kuis/pustaka", function () {

        return view("pages.dashboard.pustaka");
    })->middleware('auth')->name("pustaka");

    Route::get("peserta/", function () {
        return view("pages.dashboard.peserta");
    })->name("peserta");
    // end dashboard route

    Route::get("/pustaka/kuis/{idKuis}", [QuizController::class, 'quizPage'])->name("pustaka.kuis");
  

    Route::get("/pustaka/kuis/editor/{jenis}/{idkuis}", [QuizController::class, 'quizEditor'])->name("pustaka.kuis.editor");
    Route::get("/pustaka/kuis/editor/edit/{jenis}/{idkuis}/{id_soal}", [QuizController::class, 'quizEditor'])->name("pustaka.kuis.editor.edit");
    // ---------------------------- Client Area----------------------------------
    Route::get("kuis/preview/{mode}", function ($mode) {

        if ($mode == "cbt") {
            return view("template.quiz_template.quiz");
        } else {
            return view("template.quiz_template.form");
        }

    })->name("pustaka.kuis.preview");



    // ---------------------------------------------------------------------------

    Route::controller(hasilController::class)->group(function () {
        Route::get('/hasil/', "daftarKuis")->name("hasil.daftar");
        Route::get('/hasil/{kode_kuis}', "daftarPesertaKuis")->name("hasil.daftar.peserta");
        Route::get('/hasil/{type}/{kode_kuis}/peserta/{id_peserta}', "hasilPeserta")->name("hasil.daftar.peserta.hasil");
    });
});
Route::controller(QuizController::class)->group(function () {
    Route::post("/quiz/banner/upload", "bannerHandler")->name("banner_upload");
    Route::get("/pustaka/kuis/soal/download/{idKuis}","dowhloadQuiz")->name("quiz.download");
});
// end midlleware group

Route::get('/', function () {
    return view("template.main-page.pages.landingPage");
})->name("landingPage");

Route::get("/Daftar", function () {
    return view("template.main-page.pages.signUpPage");
})->name("daftar");


// dashboard user




Route::controller(CBTQuiz::class)->group(function () {

    Route::get("/cbt/hasil/{kode_kuis}/{id_peserta}", "hasil")->name("cbt.result");
    Route::get("/cbt/{id_quiz}", "index")->name("cbt")->middleware("check.peserta");
    Route::get("/login/cbt", "login")->name('cbt.login');
    Route::get('/cbt', function () {
        return redirect()->route('cbt.login');
    });

    // Route::get("/cbt/{id_quiz}/{id_peserta}","");
    // route untuk autentikasi user;
    Route::post("/cbt/authenticate", "authPeserta")->name("cbt.auth");
    Route::get("/cbt/peserta/unauthenticate/", "forgetPeserta")->name("cbt.unauth");

});


