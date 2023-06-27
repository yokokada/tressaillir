<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
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


//イベント登録
Route::post( '/event', [EventController::class, "store"]);
//イベント一覧表示
Route::get('/event-index', [EventController::class, "index"]);
//イベント詳細
Route::get('/event-detail/{id}', [EventController::class, "show"])->name('event-detail');

Route::get('/event-cordinator', [EventController::class, "eventCordinatorForm"]);

//飲み会情報一覧画面
Route::get('/index', [MemberController::class, "index"]);
//入力画面表示
Route::get('/create', [MemberController::class, "createForm"]);

Route::get('/register', function () {
    return view('/auth/register');
});
//参加者入力フォームのデータ登録
Route::post('/members', [MemberController::class, "store"]);

//認証
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
