<?php

use App\Http\Controllers\PesertaController;
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
    Route::controller(userController::class)->group(function(){
        // auth route signIn
        Route::post('/authenticate',"signIn")->name("signIn");
        // auth route signUp
        Route::post('/signup',"signUp")->name("signUp");
    })->middleware("auth");

    Route::controller(PesertaController::class)->group(function(){
        Route::post("/peserta","store")->name("addPeserta");
        Route::get("/peserta","index")->name("allPeserta");
        Route::get("/peserta/{id}","show")->name("getPeserta");
        Route::delete("/peserta/{id}","destroy")->name("delPeserta");
        Route::put("/peserta/{id}","edit")->name("upPeserta");
    });
});

