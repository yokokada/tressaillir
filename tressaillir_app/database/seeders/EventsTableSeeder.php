<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.: void
     */
    public function run()
    {
        // 初期ユーザーデータの定義
        $events = [
            [
                'event' => '新年会',
                'date' => '2023-06-27',
                'time' => '18:30',
                'event_place' => '鳥貴族',
                'place_url' => '〒151-0053 東京都渋谷区代々木５丁目１−１',
            ],
            [
                'event' => '新人歓迎会',
                'date' => '2023-07-07',
                'time' => '17:00',
                'event_place' => 'CoCo壱番屋',
                'place_url' => '〒121-0053 東京都渋谷区幡ヶ谷3丁目１−１',
            ],
            [
                'event' => '忘年会',
                'date' => '2024-03-27',
                'time' => '20:00',
                'event_place' => '笑笑',
                'place_url' => '〒131-0053 東京都千代田区代々木５丁目１−１',
            ],
            // 追加のユーザーデータ
        ];
        foreach ($events as $event) {
            Event::create($event);
        }
    }
}