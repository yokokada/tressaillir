<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->get();
        return view('event-index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    //幹事の飲み会入力画面
    public function eventCordinatorForm()
    {
        return view('event-cordinator');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = new Event;
        $event->user_id  = Auth::user()->id;
        $event->event   = $request->event;
        $event->date     = $request->date;
        $event->time     = $request->time;
        $event->event_place      = $request->event_place;
        $event->place_url        = $request->place_url;
        $event->hash = Str::random(20);
        $event->save();

        //テーブルに保存
        return redirect('/event-index')->with('success', '登録しました！');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::find($id);
        return view('event-detail')->with('event', $event);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
