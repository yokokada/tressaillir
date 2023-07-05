<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header class="bg-red-600 p-3">
        <div class="flex justify-between items-center">
            <h1 class="text-white font-bold">{{ $event_title->event->event }}</h1>
            <a href="/close/{{ $event->id }}" class="text-white font-bold">お会計</a>
        </div>
    </header>

    <div class="flex justify-center items-cente text-gray-700">
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
                        <p class="mb-2"> 総人数は{{ $total_member }}人です。</p>
                        <div id="container">
                            @auth
                            <div class="table-container p-2 mb-4 mt-4">
                                <div class="">テーブル1 <input class="peopleInput w-16 h-8 rounded-lg" type="number" min="0"
                                        max="20">人
                                    <button
                                        class="add-button bg-green-500 text-white rounded-lg ml-1 mr-1 px-2 py-1">＋</button>
                                    <button class="remove-button bg-gray-400 text-white rounded-lg px-2 py-1">ー</button>
                                </div>
                            </div>
                            @endauth
                        </div>
                        @auth
                        <div class="mb-4">
                            <button id="distributeButton"
                                class="px-4 py-2 bg-red-600 hover:bg-yellow-400 text-white font-bold rounded-lg">席決めスタート</button><br>
                        </div>
                        @endauth
                        <div class="set">
                            <div id="resultContainer"></div>
                        </div>
                    </div>
                    <div id="members-container" class="mt-8 grid grid-cols-2 gap-4">
                        @foreach ($members as $member)
                        <div class="flex items-center justify-center flex-col">
                            <div id="show-profile" class="cursor-pointer" onclick="openModal({{ $member->id }})">
                                <p class="text-lg font-bold mb-1" id="member-nickname">{{ $member->nickname }}</p>
                                <img src="{{ asset($member->icon) }}" class="w-20 h-20 rounded-full object-cover">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{-- 以下ファーストドリンクタブ --}}
                @auth
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
                <!-- 以下、飲み会終了タブ -->
                <div x-show="activeTab===2">
                    <p class="mb-2"> 飲み会終了であれば
                        <br>以下のボタンを押して
                        <br>お会計入力画面に進んでください
                    </p><br>
                    <a href="/pay/{{ $event_title->event->id }}/{{ $event_title->event->hash }}"
                        class="px-4 py-2 bg-gray-700 text-white font-bold rounded-lg">飲み会終了</a>
                </div>
                @endauth
            </div>
        </div>
    </div>
    @include('components.profile-modal')

    <!--  タブの切り替えJS -->
    <script>
        function setup() {
        return {
          activeTab: 0,
          tabs: [
            @auth
              "席決め",
              "ファーストドリンク",
              "飲み会終了"
            @else
              "席決め"
            @endauth
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
    @include('components.profile-modal')
    <script>
        //プロフィール詳細表示関係
          function openModal(id) {
            const url = "/getprofile";
            const data = { id: id };
            const headers = {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document
              .querySelector("[name='csrf-token']")
              .getAttribute("content"),
            };
            fetch(url, {
              method: "POST",
              headers: headers,
              body: JSON.stringify(data),
            })
            .then((response) => {
              if (!response.ok) {
                throw new Error("Fetch failed");
              }
              return response.json();
            })
            .then((res) => {
              document.getElementById("nickname").innerHTML = res.nickname;
              document.getElementById("hobby").innerHTML = res.hobby;
              document.getElementById("firstdrink").innerHTML = res.firstdrink;
              var assetBaseUrl = "{{ asset('') }}";
              document.getElementById("icon").src = assetBaseUrl + res.icon;
              
              const drinks = [
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
              ];
              let drink = res.firstdrink;
              if (drink >= 0 && drink < drinks.length) {
                document.getElementById('firstdrink').textContent = drinks[drink];
              }
            })
            .catch((error) => {
              alert("Fetch error");
            });
            const modalContainer = document.querySelector(".modal-container");
            modalContainer.style.display = "flex";
            modalContainer.classList.remove("opacity-0", "invisible");
            modalContainer.classList.add("opacity-100", "visible");
          }
    </script>
    <script>
        document.querySelector(".modal-close").addEventListener("click", function () {
          const modalContainer = document.querySelector(".modal-container");
          modalContainer.style.display = "none";
          modalContainer.classList.add("opacity-0", "invisible");
          modalContainer.classList.remove("opacity-100", "visible");
        });
    
        document.addEventListener("DOMContentLoaded", function() {
          const closeModal = document.querySelector('.modal-close');
        // モーダルを閉じる
          closeModal.addEventListener('click', function() {
            const modalContainer = document.querySelector(".modal-container");
            modalContainer.style.display = 'none';
            modalContainer.classList.remove("opacity-100", "visible");
            modalContainer.classList.add("opacity-0", "invisible");
          });
        });
    </script>
</body>

</html>