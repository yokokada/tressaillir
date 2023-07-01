<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="bg-red-700 p-3">
        <nav class="flex justify-between items-center">
            <div class="text-white text-lg font-bold">
                {{-- <p>{{ $event->event }}</p> --}}
            </div>
            <button id="menu-toggle" class="text-white p-2 rounded-md">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>
        </nav>
        <div id="menu" class="hidden py-2 flex flex-col items-end">
            <a href="#" class="block text-white px-4 py-2">メニュー項目1</a>
            <a href="#" class="block text-white px-4 py-2">メニュー項目2</a>
            <a href="#" class="block text-white px-4 py-2">メニュー項目3</a>
        </div>
    </header>
    
    <div class="flex justify-center items-center">
        <!--actual component start-->
        <div div x-data="setup()">
            {{-- タブ設定 --}}
            <ul class="flex justify-center items-center my-4">
                <template x-for="(tab, index) in tabs" :key="index">
                    <li class="cursor-pointer py-2 px-4 text-gray-500 border-b-8"
                        :class="activeTab===index ? 'text-green-500 border-green-500' : ''" @click="activeTab = index"
                        x-text="tab"></li>
                </template>
            </ul>
                  {{-- 以下参加者タブ --}}
            <div class="text-center p-8">
                <div x-show="activeTab===0">
                    <div id="table-container">
                            {{-- 総人数 --}}
                            <p class="mb-2"> 総人数は{{ App\Models\Member::count() }}人です。</p>
                            <div id="container" >
                                <div class="table-container p-2 mb-4 mt-4">
                                    <div class="">テーブル1 <input class="peopleInput w-16 h-8 rounded-lg" type="number" min="0" max="20" >人
                                        <button class="add-button bg-green-500 text-white rounded-lg ml-1 mr-1 px-2 py-1">＋</button>
                                        <button class="remove-button bg-gray-400 text-white rounded-lg px-2 py-1">ー</button>        
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                            <button id="distributeButton" class="border border-gray-500 rounded-lg px-4 py-2">席決めスタート</button><br>

                            </div>
                            <div class="set">
                            <div id="resultContainer"></div>
                        </div>
                    </div>
                        <div id="members-container" class="mt-8 grid grid-cols-2 gap-4">
                            @foreach ($members as $member)
                                <div class="flex items-center justify-center flex-col">
                                    <p class="text-lg font-bold mb-1" id="member-nickname">{{ $member->nickname }}</p>
                                    <img src="{{ asset($member->icon) }}" class="w-20 h-20 rounded-full">
                                </div>
                            @endforeach
                        </div>
                    </div>   
                    {{-- 以下ファーストドリンクタブ --}}
                    <div x-show="activeTab===1">
                        <div class='' id="firstdrink-container">
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
                                <div class="">
                                    <p class="text-lg">{{ $drinkName }}　{{ $quantities }}杯</p>
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
              "席決め",
              "ファーストドリンク",
          ]
        };
      };
    </script>
    <!-- テーブル追加するJS -->
    <script src="{{ asset('js/add-table.js') }}"></script>
    <!-- 席分配JS -->
    <script src="{{ asset('js/change-seats.js') }}"></script>
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');
      
        menuToggle.addEventListener('click', () => {
          menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
