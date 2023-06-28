<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Event;

class EventshowController extends Controller
{
    // public function index()
    // {
    //      // テーブル1からデータを取得
    //     $members = Member::all();
    //      // テーブル2からデータを取得
    //     $events = Event::all();

    //     // ビューを表示し、データを渡す
    //     return view('event', [
    //         'members' => $members,
    //         'events' => $events,
    // ]);
    // }

    public function show($eid)
    {
        // テーブル1からデータを取得
        $members = Member::where('event_id', '=', $eid)->get();
        // テーブル2からデータを取得
        $events = Event::where('id', '=', $eid)->get();

        // ビューを表示し、データを渡す
        return view('event', [
            'members' => $members,
            'events' => $events,
        ]);
    }
}


    