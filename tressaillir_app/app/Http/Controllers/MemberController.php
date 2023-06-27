<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth;  

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::orderBy('created_at', 'asc')->get();
        // return view('members')->with('members',$members);
            return view('index', ['members' => $members]);
    }
    public function event()
    {
        $members = Member::orderBy('created_at', 'asc')->get();
            return view('event', ['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createForm()
    {
        return view('create');
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
            $member->save();

            //テーブルに保存
            return redirect('/index')->with('success','登録しました！');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
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
