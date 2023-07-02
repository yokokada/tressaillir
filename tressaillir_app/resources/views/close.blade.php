<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>終了画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class=text-red-700>
    <header class="bg-red-700 p-3">
        <nav class="flex justify-between items-center">
            <h1 class="text-white font-bold">
                {{-- <p>{{ $event_title->event }}</p> --}}
            </h1>
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
    <div id="end-massege" class="mt-7 flex justify-center">
            <div>
                <p class="text-4xl font-bold mb-5 flex justify-center">楽しかったですね！<br>また飲みましょう！</p></br>
                <p class="text-lg flex justify-center">女性のお会計額は</p>
                <p class="text-4xl font-bold mb-5 flex justify-center" id="womenAmount"></p>
                <p class="text-lg flex justify-center">女性以外の方のお会計は</p>
                <p class="text-4xl font-bold mb-5 flex justify-center" id="menAmount"></p><br>

                <p class="text-xl font-bold mb-5 flex justify-center">このデータは<div id="countdown"class="text-4xl font-bold mb-5 flex justify-center"></div>
                <p class="text-xl font-bold mb-5 flex justify-center">後に消去されます</p><br><br>

                <p class="text-4xl font-bold mb-5 flex justify-center">２次会の場所はコチラ</p><br>
                <p class="text-lg flex justify-center">お店の名前</p>
                <p id="eventPlace" class="text-4xl font-bold mb-5 flex justify-center"></p>
                <p class="text-lg flex justify-center">住所</p>
                <a id="placeUrl" class="text-xl font-bold mb-5 flex justify-center"></a>
            </div>    
    </div>
    
    <script>
        window.onload = function() {
        // ローカルストレージからデータを取得
        var eventPlace = localStorage.getItem('eventPlace');
        var placeUrl = localStorage.getItem('placeUrl');

        // 取得したデータをHTMLに表示
        document.getElementById('eventPlace').innerText = eventPlace;
        // URLをそのまま表示
        var placeUrlElement = document.getElementById('placeUrl');
        placeUrlElement.href = placeUrl;
        placeUrlElement.innerText = placeUrl;


        // お会計額も取得し表示
        var menAmount = localStorage.getItem('menAmount');
        var womenAmount = localStorage.getItem('womenAmount');
        document.getElementById('menAmount').innerText = menAmount + "円です";
        document.getElementById('womenAmount').innerText = womenAmount + "円です";
    }
        // カウントダウン表示するためのJS
        document.addEventListener('DOMContentLoaded', function() {
        var startTime = localStorage.getItem('startTime');
        var endTime = new Date(parseInt(startTime) + 60 * 60 * 1000); // 1時間後

        var timer = setInterval(function() {
        var now = new Date().getTime();
        var distance = endTime - now;

        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        

        // 2桁で表示
        minutes = String(minutes).padStart(2, '0');
        seconds = String(seconds).padStart(2, '0');

        document.getElementById("countdown").innerHTML = minutes + ":" + seconds;

        if (distance < 0) {
            clearInterval(timer);
            document.getElementById("countdown").innerHTML = "EXPIRED";
        }
            }, 1000);
        });

        
    </script>

</body>
</html>
