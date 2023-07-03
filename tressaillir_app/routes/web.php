<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\EventshowController;
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

// ーーーーーーーーーーーートップ画像ーーーーーーーーーーーーーーーー
Route::get('/', function () {
    return view('/welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/welcome/{param1}/{param2}', 'App\Http\Controllers\YourController@redirectToWelcome');
Route::get('/welcome2', function () {
    return view('welcome2');
});

// ーーーーーーーーーーーーイベント登録関係ーーーーーーーーーーーーーーーー
//イベント情報入力画面 event-cordinator.blade.php
Route::get('/event-cordinator', [EventController::class, "eventCordinatorForm"])->middleware(['auth', 'verified'])->name('dashboard');

//イベント登録処理 ファイルなし
Route::post('/event-register', [EventController::class, "store"]);
//イベントタイトル一覧表示 event-index.blade.php
Route::get('/event-index', [EventController::class, "index"])->middleware(['auth', 'verified'])->name('dashboard');
//イベント詳細ページ event-detail.blade.php
Route::get('/event-detail/{id}', [EventController::class, "show"])->middleware(['auth', 'verified'])->name('event-detail');

// ーーーーーーーーーーーー参加者登録関係ーーーーーーーーーーーーーーーー
//参加者情報入力画面 create.blade.php
Route::get('/create/{id}/{hash}', [MemberController::class, "createForm"])->name('participantsForm');
// Route::get('/create', [MemberController::class, "createForm"]);
//参加者入力フォームのデータ登録 ファイルなし
Route::post('/members', [MemberController::class, "store"]);

// ーーーーーーーーーーーー表示関係ーーーーーーーーーーーーーーーーーーー
// 飲み会前画面 event.blade.php
// Route::get('/event/{id}/{hash}', [EventshowController::class, 'show']);
Route::get('/event/{id}', [EventshowController::class, 'show']);

//席替え表示画面 index.blade.php
// Route::get('/index/{id}/{hash}', [MemberController::class, "index"]);
Route::get('/index/{id}', [MemberController::class, "index"]);

// お会計画面 pay.blade.php
Route::get('/pay/{id}', [MemberController::class, "pay"]);
// 飲み会終了画面 close.blade.php
Route::get('/close/{id}', [MemberController::class, "close"]);

// ーーーーーーーーーーログイン認証ーーーーーーーーーーーーーーーーーーーーー
// ブリーズの登録画面
Route::get('/register', function () {
    return view('/auth/register');
});
//認証
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
