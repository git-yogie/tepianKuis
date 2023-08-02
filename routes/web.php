<?php

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

Route::get('/', function () {
    return view("template.main-page.pages.landingPage");
})->name("landingPage");

Route::get("/Daftar", function () {
    return view("template.main-page.pages.signUpPage");
})->name("daftar");


// dashboard user
Route::controller(dashboard::class)->group(function(){
    Route::get("/dashboard","index")->name("dashboard");
})->middleware("auth");

Route::controller(userController::class)->group(function(){
    Route::get("/dashboard/logout")->name("dashboard.logout");
})->middleware("auth"); 

// dashboard -> pustaka kuis
// ------------------------------ dev Area ------------------------------------
Route::get("kuis/pustaka", function () {
    return view("pages.dashboard.pustaka");

})->name("pustaka");

Route::get("peserta/", function () {
    return view("pages.dashboard.peserta");
})->name("peserta")->middleware("auth");
Route::get("peserta/hasil", function () {
    return view("pages.dashboard.hasil");
})->name("hasil");
// end dashboard route

Route::get("/pustaka/kuis/{idKuis}", function () {
    return view("pages.dashboard.kuis_detail");
})->name("pustaka.kuis");

Route::get("/pustaka/kuis/editor/{jenis}", function ($jenis) {
    return view("pages.dashboard.kuis_editor.template.editor");
})->name("pustaka.kuis.editor");

// ---------------------------- Client Area----------------------------------
Route::get("kuis/preview/{mode}", function ($mode) {

    if ($mode == "cbt") {
        return view("template.quiz_template.quiz");
    } else {
        return view("template.quiz_template.form");
    }
    
})->name("pustaka.kuis.preview");
// ---------------------------------------------------------------------------