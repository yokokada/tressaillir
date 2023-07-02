<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Jobs\DeleteEventContent;
use Carbon\Carbon;

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

    public function show($id)
    {
        // テーブル1からデータを取得
        // $members = Member::where('event_id', '=', $eid)->get();
        // テーブル2からデータを取得
        $event = Event::with('members')->where('user_id', Auth::user()->id)->find($id);
        // $event = Event::with('members')->find($eid);
        // $event = Event::find($eid)->first();

        // ビューを表示し、データを渡す
        // return view('event', [
        //     // 'members' => $members,
        //     // $eventをeventという名前で渡す。渡した先では$つければ使える
        //     'event' => $event,
        // ]);
        // if (!$event || $event->hash !== $hash) {
        //     abort(403, 'アクセスエラーです');
        // }
        return view('event', compact('event'));
    }

    // 1時間後に消す設定
    public function scheduleDeletion(Request $request)
        {
            $eventId = $request->input('event_id');
            
            // ジョブを1時間後にディスパッチ
            $when = Carbon::now()->addHour();
            DeleteEventContent::dispatch($eventId)->delay($when);
            
            return response()->json(['message' => '内容は1時間後に削除されます']);
        }
        
}