<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FaceBookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('auth')->name('auth.')->group( function(){
    Route::get('facebook', [FaceBookController::class, 'loginUsingFacebook'])->name('facebook');
    Route::get('facebook/callback', [FaceBookController::class, 'callbackFromFacebook'])->name('facebook_callback');
    Route::get('google', [GoogleController::class, 'redirectToGoogle'])->name('google');
    Route::get('google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google_callback');
});
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/cari', [FrontController::class, 'cari'])->name('cari');
Route::get('page/{page}', [FrontController::class, 'page'])->name('page');
Route::get('/post/{slug}', [FrontController::class, 'artikel'])->name('baca_artikel');
Route::get('/kategori/{slug}', [FrontController::class, 'post_kategori'])->name('kategori');
Route::get('/tag/{slug}', [FrontController::class, 'post_tag'])->name('tag');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [StaterkitController::class, 'dashboard'])->name('dashboard');
    Route::prefix('artikel')->name('artikel.')->group( function(){
        Route::get('/', [StaterkitController::class, 'artikel'])->name('semua');
        Route::get('/tambah', [StaterkitController::class, 'tambah_artikel'])->name('tambah');
        Route::get('komentar', [StaterkitController::class, 'komentar'])->name('komentar');
    });
    Route::prefix('halaman')->name('halaman.')->group( function(){
        Route::get('/', [StaterkitController::class, 'halaman'])->name('semua');
        Route::get('/tambah', [StaterkitController::class, 'tambah_halaman'])->name('tambah');
    });
    Route::prefix('referensi')->name('referensi')->group( function(){
        Route::get('/{laman}', [StaterkitController::class, 'referensi']);
    });
    Route::prefix('administrasi')->name('administrasi')->group( function(){
        Route::get('/{laman}', [StaterkitController::class, 'administrasi']);
        Route::get('/{laman}/tambah-data', [StaterkitController::class, 'administrasi_add'])->name('.add');
    });
    Route::prefix('keuangan')->name('keuangan')->group( function(){
        Route::get('/{laman}', [StaterkitController::class, 'keuangan']);
    });
    Route::prefix('kinerja-guru')->name('kinerja-guru')->group( function(){
        Route::get('/{laman}', [StaterkitController::class, 'kinerja_guru']);
    });
    Route::get('/users', [StaterkitController::class, 'users'])->name('users');
});
Route::get('send-mail', function () {
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
    \Mail::to('akun.temporary83@gmail.com')->send(new \App\Mail\KirimEmail($details));
    dd("Email is Sent.");
});


