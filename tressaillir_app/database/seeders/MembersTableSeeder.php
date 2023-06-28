<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 初期ユーザーデータの定義
        $members = [
            [
                'nickname' => '陽子',
                'icon' => 'storage/img/T05DB2XTAD6-U05DHRW6Y73-c7001c146be4-512.png',
                'hobby' => '看護',
                'sex' => '1',
                'firstdrink' => '1',
                'event_id' => '1',
            ],
            [
                'nickname' => 'しょうご',
                'icon' => 'storage/img/T05DB2XTAD6-U05D04Z051R-1cbccaba0e41-512.jpg',
                'hobby' => '筋トレ',
                'sex' => '0',
                'firstdrink' => '4',
                'event_id' => '1',
            ],
            [
                'nickname' => 'HIBO',
                'icon' => 'storage/img/T05DB2XTAD6-U05D8J2TK36-85ab527b494f-512.png',
                'hobby' => 'スケボー',
                'sex' => '0',
                'firstdrink' => '5',
                'event_id' => '1',
            ],
            [
                'nickname' => '彩ちゃん',
                'icon' => 'storage/img/228043130151392_1200.jpg',
                'hobby' => '昼顔',
                'sex' => '1',
                'firstdrink' => '2',
                'event_id' => '1',
            ],
            [
                'nickname' => '照英',
                'icon' => 'storage/img/1418.jpg',
                'hobby' => 'スケボー',
                'sex' => '2',
                'firstdrink' => '1',
                'event_id' => '1',
            ],
            
            [
                'nickname' => '陽子',
                'icon' => 'storage/img/T05DB2XTAD6-U05DHRW6Y73-c7001c146be4-512.png',
                'hobby' => '看護',
                'sex' => '1',
                'firstdrink' => '1',
                'event_id' => '2',
            ],
            [
                'nickname' => 'しょうご',
                'icon' => 'storage/img/T05DB2XTAD6-U05D04Z051R-1cbccaba0e41-512.jpg',
                'hobby' => '筋トレ',
                'sex' => '0',
                'firstdrink' => '4',
                'event_id' => '2',
            ],
            [
                'nickname' => 'HIBO',
                'icon' => 'storage/img/T05DB2XTAD6-U05D8J2TK36-85ab527b494f-512.png',
                'hobby' => 'スケボー',
                'sex' => '0',
                'firstdrink' => '5',
                'event_id' => '2',
            ],
            [
                'nickname' => '彩ちゃん',
                'icon' => 'storage/img/228043130151392_1200.jpg',
                'hobby' => '昼顔',
                'sex' => '1',
                'firstdrink' => '2',
                'event_id' => '2',
            ],
            [
                'nickname' => '照英',
                'icon' => 'storage/img/1418.jpg',
                'hobby' => 'スケボー',
                'sex' => '2',
                'firstdrink' => '1',
                'event_id' => '2',
            ],

            [
                'nickname' => '陽子',
                'icon' => 'storage/img/T05DB2XTAD6-U05DHRW6Y73-c7001c146be4-512.png',
                'hobby' => '看護',
                'sex' => '1',
                'firstdrink' => '1',
                'event_id' => '3',
            ],
            [
                'nickname' => 'しょうご',
                'icon' => 'storage/img/T05DB2XTAD6-U05D04Z051R-1cbccaba0e41-512.jpg',
                'hobby' => '筋トレ',
                'sex' => '0',
                'firstdrink' => '4',
                'event_id' => '3',
            ],
            [
                'nickname' => 'HIBO',
                'icon' => 'storage/img/T05DB2XTAD6-U05D8J2TK36-85ab527b494f-512.png',
                'hobby' => 'スケボー',
                'sex' => '0',
                'firstdrink' => '5',
                'event_id' => '3',
            ],
            [
                'nickname' => '彩ちゃん',
                'icon' => 'storage/img/228043130151392_1200.jpg',
                'hobby' => '昼顔',
                'sex' => '1',
                'firstdrink' => '2',
                'event_id' => '3',
            ],
            [
                'nickname' => '照英',
                'icon' => 'storage/img/1418.jpg',
                'hobby' => 'スケボー',
                'sex' => '2',
                'firstdrink' => '1',
                'event_id' => '3',
            ],
            // 追加のユーザーデータ
        ];
        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
