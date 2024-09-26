<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\PerkuliahanController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KknController;
use App\Http\Controllers\OrasiController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\PengembangpengajaranController;
use App\Http\Controllers\PengembangprogkulController;
use App\Http\Controllers\PengujiController;
use App\Http\Controllers\SeminarController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [FormsController::class, 'form'])->name('forms');
Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/dashboard', [DosenController::class, 'index']);
    Route::post('/store', [DosenController::class, 'store']);
    Route::post('/update/{id}', [DosenController::class, 'update']);
    Route::get('/destroy/{id}', [DosenController::class, 'destroy']);


    Route::get('/perkuliahan', [PerkuliahanController::class, 'index']);
    Route::post('/perkuliahan/store', [PerkuliahanController::class, 'store']);
    Route::post('/perkuliahan/update/{id}', [PerkuliahanController::class, 'update']);
    Route::get('/perkuliahan/destroy/{id}', [PerkuliahanController::class, 'destroy']);

    Route::get('/bimbingan', [BimbinganController::class, 'index']);
    Route::post('/bimbingan/store', [BimbinganController::class, 'store']);
    Route::post('/bimbingan/update/{id}', [BimbinganController::class, 'update']);
    Route::get('/bimbingan/destroy/{id}', [BimbinganController::class, 'destroy']);

    Route::get('/jabatan', [JabatanController::class, 'index']);
    Route::post('/jabatan/store', [JabatanController::class, 'store']);
    Route::post('/jabatan/update/{id}', [JabatanController::class, 'update']);
    Route::get('/jabatan/destroy/{id}', [JabatanController::class, 'destroy']);

    Route::get('/KKN', [KknController::class, 'index']);
    Route::post('/KKN/store', [KknController::class, 'store']);
    Route::post('/KKN/update/{id}', [KknController::class, 'update']);
    Route::get('/KKN/destroy/{id}', [KknController::class, 'destroy']);

    Route::get('/orasi', [OrasiController::class, 'index']);
    Route::post('/orasi/store', [OrasiController::class, 'store']);
    Route::post('/orasi/update/{id}', [OrasiController::class, 'update']);
    Route::get('/orasi/destroy/{id}', [OrasiController::class, 'destroy']);

    Route::get('/pembina', [PembinaController::class, 'index']);
    Route::post('/pembina/store', [PembinaController::class, 'store']);
    Route::post('/pembina/update/{id}', [PembinaController::class, 'update']);
    Route::get('/pembina/destroy/{id}', [PembinaController::class, 'destroy']);

    Route::get('/pengembang_pengajaran', [PengembangpengajaranController::class, 'index']);
    Route::post('/pengembang_pengajaran/store', [PengembangpengajaranController::class, 'store']);
    Route::post('/pengembang_pengajaran/update/{id}', [PengembangpengajaranController::class, 'update']);
    Route::get('/pengembang_pengajaran/destroy/{id}', [PengembangpengajaranController::class, 'destroy']);

    Route::get('/pengembang_progkul', [PengembangprogkulController::class, 'index']);
    Route::post('/pengembang_progkul/store', [PengembangprogkulController::class, 'store']);
    Route::post('/pengembang_progkul/update/{id}', [PengembangprogkulController::class, 'update']);
    Route::get('/pengembang_progkul/destroy/{id}', [PengembangprogkulController::class, 'destroy']);

    Route::get('/penguji', [PengujiController::class, 'index']);
    Route::post('/penguji/store', [PengujiController::class, 'store']);
    Route::post('/penguji/update/{id}', [PengujiController::class, 'update']);
    Route::get('/penguji/destroy/{id}', [PengujiController::class, 'destroy']);

    Route::get('/Seminar', [SeminarController::class, 'index']);
    Route::post('/Seminar/store', [SeminarController::class, 'store']);
    Route::post('/Seminar/update/{id}', [SeminarController::class, 'update']);
    Route::get('/Seminar/destroy/{id}', [SeminarController::class, 'destroy']);
});
