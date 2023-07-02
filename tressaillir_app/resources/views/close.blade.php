<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>終了画面</title>
</head>
<body>
    <div>
            <div>
                <p>楽しかったですね！</p>
                <p>また飲みましょう！</p><br>
            </div>
            <div>
                <p>女性のお会計額は</p>
                <p id="womenAmount"></p><br>
                <p>男性やそれ以外の方のお会計は</p>
                <p id="menAmount"></p><br>
            </div>
            <div>
                <p>このデータは</p>
                <p><div id="countdown"></div>後に消去されます</p><br>

            </div>
            <div>
                <p>２次会の場所はコチラ</p>
                <p id="eventPlace"></p>
                <a id="placeUrl">地図を見る</a>
            </div>
    </div>
    
    <script>
        window.onload = function() {
        // ローカルストレージからデータを取得
        var eventPlace = localStorage.getItem('eventPlace');
        var placeUrl = localStorage.getItem('placeUrl');

        // 取得したデータをHTMLに表示
        document.getElementById('eventPlace').innerText = eventPlace;
        document.getElementById('placeUrl').href = placeUrl;

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
