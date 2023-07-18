<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view("template.main-page.pages.landingPage");
});

Route::get("/Daftar",function(){
    return view("template.main-page.pages.signUpPage");
})->name("daftar");


// dashboard user
Route::get("/dashboard",function(){
    return view("pages.dashboard.index");
})->name("dashboard");

// dashboard -> pustaka kuis
Route::get("kuis/pustaka",function(){
    return view("pages.dashboard.pustaka");
    
})->name("pustaka");

Route::get("peserta/",function(){
    return view("pages.dashboard.peserta");
})->name("peserta");
Route::get("peserta/hasil",function(){
    return view("pages.dashboard.hasil");
})->name("hasil");
// end dashboard route
