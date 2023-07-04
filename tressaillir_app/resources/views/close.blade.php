<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>終了画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* 紙吹雪のスタイル */
        .confetti {
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .confetti div {
            width: 10px;
            height: 10px;
            background-color: #f00; /* 紙吹雪の色を設定 */
            position: absolute;
            border-radius: 50%;
            animation: confetti-fall linear infinite;
        }

        /* 紙吹雪のアニメーション */
        @keyframes confetti-fall {
            0% {
                transform: translateY(0);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div id="end-massege" class="flex justify-center p-10 text-gray-700 bg-red-600">
        <div>
            <div class="logo-container mb-10 p-4"><img src="{{ asset('img/Nomoca__1.png') }}" alt="Logo"></div>
                <div class="mb-10">
                    <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow">
                    <h5 class="mb-4 text-xl font-bold text-gray-700">1人あたり お会計金額</h5>
                    <span class="bg-red-500 pt-1 pb-1 pr-4 pl-4 text-s fcont-normal text-white rounded">女性</span>
                    <div class="mt-2 flex items-baseline text-red-500">
                    <span class="text-3xl font-semibold">¥</span>
                    <span class="text-5xl font-extrabold tracking-tight">
                    <p class="mb-4 text-5xl font-bold flex text-right" id="womenAmount"></p>
                    </span>
                </div>
                    <span class="bg-blue-500 pt-1 pb-1 pr-4 pl-4 text-s font-normal text-white rounded">男性・その他</span>
                        <div class="mt-2 flex items-baseline text-blue-500 ">
                            <span class="text-3xl font-semibold">¥</span>
                            <span class="text-5xl font-extrabold tracking-tight">
                            <p class="text-5xl font-bold" id="menAmount"></p>
                            </span>
                        </div>
                    </div>
                </div>

            <div class="bg-white p-4 rounded-lg mb-10 border-gray-200 shadow">
                <h6 class="mb-4 text-xl font-bold">2次会場所</h6>
                <span class="bg-orange-500 pt-1 pb-1 pr-4 pl-4 text-s font-normal text-white rounded">お店の名前</span>
                <p id="eventPlace" class="text-4xl font-bold mb-4 font-extrabold tracking-tight mt-2 text-orange-500"></p>
                <span class="bg-orange-500 pt-1 pb-1 pr-4 pl-4 text-s font-normal text-white rounded">地図URL</span>
                <a id="placeUrl" class="text-s font-bold flex justify-center tracking-tight mt-2 text-orange-500"></a>
            </div>

            <div class="p-4 text-white rounded-lg border-4 border-white shadow">
                <p class="text-lg font-bold flex justify-center">個人情報・飲み会データは
                <div id="countdown" class="mt-1 text-5xl font-bold flex justify-center text-white"></div>
                <p class="mt-1 text-lg font-bold flex justify-center">後に消去されます</p>
            </div>
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
            document.getElementById('menAmount').innerText = menAmount + "";
            document.getElementById('womenAmount').innerText = womenAmount + "";
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
