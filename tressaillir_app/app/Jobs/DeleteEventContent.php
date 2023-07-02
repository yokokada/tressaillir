<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class DeleteEventContent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $eventId;
    // コンストラクタでイベント番号（またはハッシュ）を受け取ります。
    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * Execute the job.
     */
    // handleメソッドでデータを削除します。
    public function handle()
    {
        // イベントデータを削除
        Event::where('event_id', $this->eventNumber)->delete();
        // メンバーデータを削除
        Member::where('event_id', $this->eventNumber)->delete();
    }
}
