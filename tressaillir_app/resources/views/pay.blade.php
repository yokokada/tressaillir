<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お会計画面</title>
    <style>
    </style>
    <!-- Tailwind CSSのリンク -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <!--------------- 会計入力画面 ---------------------->
    <!-- 会計入力 -->
    <div>
        <div>
            <h1>会計額</h1><br>
            <input type="text" id="amount" class="text-right border border-gray-300">円<br><br>
        </div>
        <div>
            <p>割り勘人数は<input  id="totalMembers" class="text-right border border-gray-300" input class="peopleInput" type="number" min="1" max="{{ App\Models\Member::count() }}" value="{{ App\Models\Member::count() }}">人です(減らす場合は入力)</p>
        </div>
        <div>
            <label for=""><input type="radio" id="evenSplit" name="sex" value="0" checked>男女均等　</label>
            <label for=""><input type="radio" id="womenLess" name="sex" value="1">女性少なめ<br><br>
            <button id="calculate" class="text-right border border-gray-300">割り勘額確認！</button><br><br>
        </div>
        <!-- 会計表示 -->
        <div>
            <p>お会計は</p><br>
            <p id="menAmount">男性 / 返答なし　　円</p><p id="womenAmount">女性　　円</p>
            <p id="remainder">余剰金　円です</p>
            <p>（100円単位で切り上げるため、集めた合計金額がお会計よりも多くなることがあります。）</p><br>
        </div>  
    </div>
    
    <!-- ２次会入力画面 -->
    <div>
        <p>２次会の場所が決まっていれば伝えられます</p>
        <p>伝える場合は入力してください</p><br>
        <div class="col-span-2">
            <label class="block">
            店名
            <input id="event_place" class="form-input p-2.5 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0" type="text" placeholder="">
            </label>
        </div>
        <div class="col-span-2">
            <label class="block">
            マップURL
            <input id="place_url" class="form-input p-2.5 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0" type="text" placeholder="">
            </label><br>
        </div>
        <div class="col-span-2">
            <button id="send-btn"class="text-right border border-gray-300" type="submit">みんなに送信！</button><br><br>
        </div>
    </div>
    <!-- 終了画面 -->
    <div>
        <div>
            <p>楽しかったですね！</p>
            <p>また飲みましょう！</p><br>
        </div>
        <div>
            <p>お会計額は</p>
            <p><input type="text" class="text-right border border-gray-300" >円です</p><br>
        </div>
        <div>
            <p>このデータは</p>
            <p>1時間後に消去されます</p><br>
        </div>
        <div>
            <p>２次会の場所はコチラ</p>
        </div>
    </div>
      
    <!-- 割り勘計算JS -->
    <script>
       document.getElementById('calculate').addEventListener('click', function() {
    var amount = parseFloat(document.getElementById('amount').value);
    var totalMembers = parseFloat(document.getElementById('totalMembers').value);

    fetch('/api/get-gender-counts')
        .then(response => response.json())
        .then(data => {
        var womenCount = data.womenCount;
        var menCount = totalMembers - womenCount;

        var menAmount, womenAmount;
        if (document.getElementById('evenSplit').checked) {
            // 均等に割る場合
            menAmount = womenAmount = Math.ceil(amount / totalMembers / 100) * 100; // 小数点以下は切り上げて100の倍数に
        } else {
            // 女性が少ない額を支払う場合。ここでは男性が全体の3/4、女性が全体の1/4を支払うとします。
            menAmount = Math.ceil(amount * 0.75 / menCount / 100) * 100; // 小数点以下は切り上げて100の倍数に
            womenAmount = Math.ceil(amount * 0.25 / womenCount / 100) * 100; // 小数点以下は切り上げて100の倍数に
        }
        // 集めたお金の合計
        var totalCollected = menAmount * menCount + womenAmount * womenCount;

        // 余り
        var remainder = totalCollected - amount;

        // 結果を表示
        document.getElementById('menAmount').innerText = "男性 / 返答なし　" + menAmount + "円";
        document.getElementById('womenAmount').innerText = "女性　" + womenAmount + "円";
        document.getElementById('remainder').innerText = "余剰金　" + remainder + "円です";

        // 結果をローカルストレージに保存
        localStorage.setItem('menAmount', menAmount);
        localStorage.setItem('womenAmount', womenAmount);
        });
    });

    document.getElementById('send-btn').addEventListener('click', function(e) {
        var eventPlace = document.getElementById('event_place').value;
        var placeUrl = document.getElementById('place_url').value;
        localStorage.setItem('eventPlace',eventPlace );
        localStorage.setItem('placeUrl', placeUrl);
    });

    </script>
    
</body>
</html>