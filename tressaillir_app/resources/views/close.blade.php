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
                <p>1時間後に消去されます</p><br>
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
    </script>

</body>
</html>
