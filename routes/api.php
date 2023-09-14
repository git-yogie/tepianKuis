<?php

use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PesertaQuizController;
use App\Http\Controllers\quizApi;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\userController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


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
        Route::post("/quiz/update/config/{id}","updateConfig")->name("upQuizConfig");
    });


    Route::controller(SoalController::class)->group(function () {
        Route::post("/soal", "store")->name("addSoal");
        Route::post("/soal/edit/{id}", "update")->name("editSoal");
        Route::get("/soal/{id_kuis}", "index")->name("allSoal");
        Route::get("/soal/show/{id}", "show")->name("getSoal");
       
    });

    Route::controller(PesertaQuizController::class)->group(function () {
        Route::post("quiz/add/peserta", "store")->name("addToKuis");
        Route::get("/quiz/get/peserta/{kode_kuis}", "index")->name("quiz.peserta.get");
        Route::post("/quiz/delete/peserta", "destroy")->name("quiz.delete");
        Route::post("/quiz/save/jawaban/{kode_kuis}/{peserta_id}","simpanJawaban")->name("quiz.simpan");

    });




});

Route::middleware('quiz.api.auth')->group(function () {
    Route::controller(quizApi::class)->group(function () {
        Route::get("embed/quiz/get/{quiz}", "index");
    });
});