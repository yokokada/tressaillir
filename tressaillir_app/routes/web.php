<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; //Add
use App\Http\Controllers\MemberController; //Add

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

//Index画面
Route::get('/index', [MemberController::class, "index"]);

Route::get('/create', function () {
    return view('create');
});

Route::get('/register', function () {
    return view('/auth/register');
});

Route::post('/members',[ MemberController::class, "store"]);

// Route::post('/books', [BookController::class, "store"])->name('book_store');
// Route::post('/lists', [IndexController::class, "store"])->name('lists_store');
