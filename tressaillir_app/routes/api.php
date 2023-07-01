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

// メンバーテーブルのカウント総数と女性の数を取得するAPIエンドポイント
Route::get('/get-gender-counts', function () {
    $totalMembers = Member::count();
    // $totalMembers = Member::count();
    $womenCount = Member::where('sex', 1)->count();
    return response()->json(['totalMembers' => $totalMembers, 'womenCount' => $womenCount]);
});
//メンバー数トータル
Route::get('/members/total', function (Request $request) {
    // クエリパラメーター(event_id)は$requestで受け取れる
    $eventId = $request->query('event_id');
    $total = Member::where('event_id', $eventId)->count();
    return response()->json(['total' => $total]);
});

// $event = Event::with('members')->where('user_id', Auth::user()->id)->find($eid);
