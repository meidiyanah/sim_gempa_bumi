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
    if(isset(Auth::user()->id)){
        if(Auth::user()->jenis_user == 1){//Admin
            return redirect('/home');
        }else{//User
            return view('welcome');
        }
    }else{
        return view('welcome');
    }
});

Auth::routes();

//DASHBOARD
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//SIMULASI
Route::get('/simulasi', [App\Http\Controllers\SimulasiController::class, 'index'])->name('simulasi');

//MASTER PETA
Route::resource("data-peta", "App\Http\Controllers\PetaController");
Route::post("data-peta/{id}/update", [App\Http\Controllers\PetaController::class, 'update'])->name('data-peta.update');

//MASTER KOTA
Route::resource("data-kota", "App\Http\Controllers\KotaController");
Route::post("data-kota/{id}/update", [App\Http\Controllers\KotaController::class, 'update'])->name('data-kota.update');

//PROFILE
Route::get("profile", [App\Http\Controllers\HomeController::class, 'profile'])->name('profile.index');
Route::post("profile/update", [App\Http\Controllers\HomeController::class, 'profile_update'])->name('profile.update');

//GANTI PASSWORD
Route::get("password", [App\Http\Controllers\HomeController::class, 'password'])->name('password.index');
Route::post("password/update", [App\Http\Controllers\HomeController::class, 'password_update'])->name('password.update');
