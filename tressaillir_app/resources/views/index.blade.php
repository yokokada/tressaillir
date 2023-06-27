<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    
    <div class="flex justify-center items-center h-screen">
        <!--actual component start-->
        <div x-data="setup()">
            <ul class="flex justify-center items-center my-4">
                <template x-for="(tab, index) in tabs" :key="index">
                    <li class="cursor-pointer py-2 px-4 text-gray-500 border-b-8"
                        :class="activeTab===index ? 'text-green-500 border-green-500' : ''" @click="activeTab = index"
                        x-text="tab"></li>
                </template>
            </ul>
    
            <div class="w-80 bg-white p-16 text-center mx-auto border">
                
                <div x-show="activeTab===0">
                    <div id="members-container" class="grid grid-cols-2 gap-4">
                        @foreach ($members as $member)
                        <div class="flex items-center flex-col">
                            <p class="text-lg">{{ $member->nickname }}</p>
                            <img src="{{ asset($member->icon) }}" class="w-16 h-16 rounded-full mr-4">
                        </div>
                        @endforeach
                    </div>
                    <button onclick="seatChange()">席決めスタート</button>
                </div>

                <div x-show="activeTab===1">
                    <div id="firstdrink-container">
                        @php
                            $uniqueFirstDrinks = $members->pluck('firstdrink')->unique();
                        @endphp
                    
                        @foreach ($uniqueFirstDrinks as $firstDrink)
                        @php
                            $quantities = $members->where('firstdrink', $firstDrink)->count();
                            $drinkName = [
                                '生ビール',
                                '瓶ビール',
                                'ノンアルコールビール',
                                'ハイボール',
                                'レモンサワー',
                                'ウーロンハイ',
                                '緑茶ハイ',
                                '烏龍茶',
                                'コーラ',
                                'ジンジャーエール',
                                'その他'
                            ][$firstDrink];
                        @endphp
                        <div class="flex items-center flex-col">
                            <p class="text-lg">{{ $drinkName }}　{{ $quantities }} 杯</p>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <script>
        function setup() {
        return {
          activeTab: 0,
          tabs: [
              "座席",
              "ファーストドリンク",
          ]
        };
      };
    </script>


<script>
    function seatChange() {
        var container = document.getElementById('members-container');
        var members = Array.prototype.slice.call(container.children); // メンバー要素の配列を作成

        // 配列をシャッフル
        for (var i = members.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var temp = members[i];
            members[i] = members[j];
            members[j] = temp;
        }

        // シャッフル後のメンバー要素をコンテナに追加
        for (var i = 0; i < members.length; i++) {
            container.appendChild(members[i]);
        }
    }
</script>
</body>
</html>
