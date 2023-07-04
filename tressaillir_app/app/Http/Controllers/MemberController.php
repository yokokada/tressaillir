<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\Event;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id, $hash)
    {
        // $members = Member::orderBy('created_at', 'asc')->get();
        $event = Event::find($id);
        $members = Member::where('event_id', $id)->orderBy('created_at', 'asc')->get();
        $total_member = Member::where('event_id', $id)->count();
        $event_title = Member::where('event_id', $id)->first();
        // $event_id = Member::where('event_id', $id)->where()->first();
        // $event_title = Member::where('event',)
        // return view('index', ['members' => $members],['event_title' => $event_title],['$total_member' => $total_member]);
        // return view('index', [
        //     'members' => $members,
        //     'event_title' => $event_title,
        //     'total_member' => $total_member
        // ]);
        //
        if (!$event || $event->hash !== $hash) {
            abort(403, 'アクセスエラーです');
        }
        return view('index', compact('members', 'total_member', 'event_title','event'));
    }

        // $event = Event::with('members')->where('user_id', Auth::user()->id)->find($eid);

    /**
     * Show the form for creating a new resource.
     */
    public function createForm($id)
    {
        $event = Event::find($id);
        // イベントが見つからない、またはハッシュが一致しない場合は403エラー
        return view('create', ['id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    //管理フラグはhiddenのためチェックなし
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'nickname'     => 'required | min:1 | max:20',
        //     'icon'         => 'nullable',
        //     'hobby'        => 'required',
        //     'sex'          => 'required',
        //     'firstdrink'   => 'required',
        //     'main_guest'   => 'required',
        // ]);

        //     //バリデーション:エラー 
        //     if ($validator->fails()) {
        //         return redirect('/')
        //             ->withInput()
        //             ->withErrors($validator);
        //     }
        //     //以下に登録処理を記述（Eloquentモデル）
        // Eloquentモデル カラム名をデータベースに情報を保存する
        //ディレクトリ名

        $dir = 'img';
        $file_name = time() . '.' . $request->file('icon')->getClientOriginalName();
        // $request->file('icon')->move(public_path('img'), $file_name);
        $request->file('icon')->storeAs('public/' . $dir, $file_name);


        $member = new Member;
        $member->kanri_flag   = $request->kanri_flag;
        $member->nickname     = $request->nickname;
        $member->icon         = 'storage/' . $dir . '/' . $file_name;
        // $member->icon         = $request->icon;
        $member->hobby        = $request->hobby;
        $member->sex          = $request->sex;
        $member->firstdrink   = $request->firstdrink;
        $member->main_guest   = $request->main_guest;
        $member->event_id     = $request->event_id;
        $member->save();

        // $test = Member::with('events')->select($request->event_id)->get();
        //テーブルに保存
        $member = Member::where('event_id',$request->event_id)->first();
        //membersテーブルの親テーブルeventsのhashカラムを取得する
        $eventHash = $member->event->hash;

        // return redirect('/event' . "/" . $request->event_id . "/" . $request->event->hash)->with('registrationCompletedMessage', 'ご登録ありがとうございます！');
        return redirect('/event' . "/" . $request->event_id . "/" . $eventHash)->with('registrationCompletedMessage', 'ご登録ありがとうございます！');
    }

    public function pay(Member $member, Request $request)
    {
        $members = Member::orderBy('created_at', 'asc')->get();
        $event_id = $request->route('id');
        $total = Member::where('event_id', $event_id)->count() ;
        $event_title = Member::where('event_id', $event_id)->first();
        // return view('members')->with('members',$members);
        return view('pay', ['members' => $members, 'total' => $total, 'event_title'=> $event_title]);
    }
    /**
     * Display the specified resource.
     */
    public function close(Member $member, Request $request)
    {
        $members = Member::orderBy('created_at', 'asc')->get();
        $event_id = $request->route('id');
        $total = Member::where('event_id', $event_id)->count() ;
        $event_title = Member::where('event_id', $event_id)->first();
        // return view('members')->with('members',$members);
        return view('close', ['members' => $members,'event_title'=> $event_title]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }
}
