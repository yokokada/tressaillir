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
        <div div x-data="setup()">
            {{-- タブ --}}
            <ul class="flex justify-center items-center my-4">
                <template x-for="(tab, index) in tabs" :key="index">
                    <li class="cursor-pointer py-2 px-4 text-gray-500 border-b-8"
                        :class="activeTab===index ? 'text-green-500 border-green-500' : ''" @click="activeTab = index"
                        x-text="tab"></li>
                </template>
            </ul>
                 {{-- 以下参加者タブ --}}
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
                        </div>
                </div>
                 {{-- 以下席替えタブ --}}
                <div x-show="activeTab===1">
                  <div id="table-container">
                        {{-- 総人数 --}}
                        <h1> 総人数は{{ App\Models\Member::count() }}人です。</h1>
                        <div id="container" >
                            <h1>テーブル1 <input  input class="peopleInput" type="number" min="1" max="20" >人</h1>
                        </div>
                            <button class="add-button">　　　　テーブル追加</button>
                        <br><br>
                        <button id="distributeButton" >席決めスタート</button>
                        <div class="set">
                        <div id="resultContainer"></div>
                      </div>
                  </div>
                </div>       
                 {{-- 以下ファーストドリンクタブ --}}
                <div x-show="activeTab===2">
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

    <!--  タブの切り替えJS -->
    <script>
      
        function setup() {
        return {
          activeTab: 0,
          tabs: [
              "参加者",
              "席決め",
              "ファーストドリンク",
          ]
        };
      };
    </script>

   <!-- テーブル追加するJS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // addボタンのクリックイベントを処理
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('add-button')) {
                    event.preventDefault();
                    // 行を複製して追加
                    var container = document.getElementById('container');
                    var row = document.querySelector('#container h1');
                    var newRow = row.cloneNode(true);
                    newRow.innerHTML = newRow.innerHTML.replace('テーブル1', 'テーブル' + (container.children.length + 1));
                    container.appendChild(newRow);
                }
            });
        });
    </script>

    <!-- 席分配JS -->
      <script src="{{ asset('js/app.js') }}">></script>
</body>
</html>
