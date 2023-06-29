<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Member;

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

// メンバーテーブルのカウント総数を取得するAPIエンドポイント
Route::get('/members/total', function () {
    $total = Member::count();
    return response()->json(['total' => $total]);
});

// メンバーテーブルのアイコン情報を取得するAPIエンドポイント
Route::get('/members/icons', function () {
    $icons = Member::pluck('icon_filename')->toArray();
    return response()->json(['icons' => $icons]);
});

// メンバーの名前を取得するAPIエンドポイント
Route::get('/members/nicknames', function (Request $request) {
    $members = Member::all();
    $nicknames = $members->pluck('nickname')->toArray();

    return response()->json($nicknames);
});