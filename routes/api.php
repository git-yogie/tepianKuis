<?php

use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PesertaQuizController;
use App\Http\Controllers\quizApi;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\userController;
use App\Http\Controllers\hasilController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => ['web']], function () {
    Route::controller(userController::class)->group(function () {
        // auth route signIn
        Route::post('/authenticate', "signIn")->name("signIn");
        // auth route signUp
        Route::post('/signup', "signUp")->name("signUp");
    })->middleware("auth");


    Route::controller(PesertaController::class)->group(function () {
        Route::post("/peserta", "store")->name("addPeserta");
        Route::get("/peserta", "index")->name("allPeserta");
        Route::get("/peserta/{id}", "show")->name("getPeserta");
        Route::delete("/peserta/{id}", "destroy")->name("delPeserta");
        Route::post("/peserta/edit/{id}", "update")->name("upPeserta");
    });


    Route::controller(QuizController::class)->group(function () {
        Route::post("/quiz", "store")->name("addQuiz");
        Route::get("/quiz", "index")->name("allQuiz");
        Route::get("/quiz/{id}", "show")->name("getQuiz");
        Route::delete("/quiz/{id}", "destroy")->name("delQuiz");
        Route::post("/quiz/edit/{id}", "update")->name("upQuiz");
        Route::post("/quiz/update/config/{id}", "updateConfig")->name("upQuizConfig");
        Route::get("/quiz/config/get/{id}", "getConfig")->name("quiz.getConfig");
    });


    Route::controller(SoalController::class)->group(function () {
        Route::post("/soal", "store")->name("addSoal");
        Route::post("/soal/edit/{id}", "update")->name("editSoal");
        Route::get("/soal/{id_kuis}", "index")->name("allSoal");
        Route::get("/soal/show/{id}", "show")->name("getSoal");
        Route::delete("/soal/delete/{id}", "destroy")->name("deleteSoal");

    });

    Route::controller(PesertaQuizController::class)->group(function () {
        Route::post("quiz/add/peserta", "store")->name("addToKuis");
        Route::get("/quiz/get/peserta/{kode_kuis}", "index")->name("quiz.peserta.get");
        Route::post("/quiz/delete/peserta", "destroy")->name("quiz.delete");
        Route::post("/quiz/save/jawaban/{peserta_id}", "savePesertaAnswer")->name("quiz.simpan");
        Route::get("/quiz/peserta/result/{kode_kuis}/{peserta_id}", "getResult")->name("quiz.peserta.result");

    });
});


// cara akses middleware 
// sertakan X-Api-Key dengan value api key user
// pada header XHR saat melakukan request api..!
Route::middleware('quiz.api.auth')->group(function () {
    Route::controller(quizApi::class)->group(function () {
        Route::get("embed/quiz/get/{quiz}", "index");
        Route::post("embed/quiz/save/{quiz}", "saveAnswer");
    });

    Route::controller(hasilController::class)->group(function () {
        // ok
        Route::get("/quiz/peserta/{quiz}", "api_daftarPesertaKuis");
    });

    Route::controller(PesertaQuizController::class)->group(function () {
        Route::get("/tepian_quiz/peserta/hasil/{quiz}", "api_getHasilQuiz");
        Route::get("/tepian_quiz/add/peserta/{id}/to/{quiz}", "api_addPesertaToQuiz");
        Route::get("/tepian_quiz/del/peserta/{id}/from/{quiz}", "api_delPesertaFromQuiz");
    });
    
    Route::controller(SoalController::class)->group(function () {
        // Route::get("quiz/soal/get/{kode_kuis}", "api_getHasilQuiz");
    });

    Route::controller(PesertaController::class)->group(function () {
        Route::get("/tepian_quiz/get/peserta", "api_getPeserta");
        Route::post("tepian_quiz/add/peserta","api_createPeserta");
        Route::get("/tepian_quiz/show/peserta/{id}" , "api_getPeserta_byId");
        Route::post("/tepian_quiz/peserta/edit/{id}", "api_updatePeserta");
    });



});