<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\WhatsappController;

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
Route::post('/pesan-masuk',[WhatsappController::class, 'webhook'])->name('post-webhook');
Route::get('/pesan-masuk',[WhatsappController::class, 'webhook'])->name('get-webhook');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [StaterkitController::class, 'dashboard'])->name('dashboard');
    Route::get('/nomor-whatsapp', [StaterkitController::class, 'nomor_whatsapp'])->name('nomor-whatsapp');
    Route::get('/nomor-whatsapp/pesan-masuk/{id}', [StaterkitController::class, 'pesan_masuk'])->name('pesan-masuk');
    Route::get('/campaign-message', [StaterkitController::class, 'campaign_message'])->name('campaign-message');
    Route::get('/received-message', [StaterkitController::class, 'received_message'])->name('received-message');
    Route::get('/auto-reply', [StaterkitController::class, 'auto_reply'])->name('auto-reply');
    Route::get('/lelang', [StaterkitController::class, 'auction'])->name('auction');
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


