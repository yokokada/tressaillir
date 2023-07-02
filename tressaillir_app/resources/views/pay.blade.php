<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お会計画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body >
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

    <!--------------- 会計入力画面 ---------------------->
    <!-- 会計入力 -->
    <div class="flex flex-col items-center mt-10">
            <div class="flex items-center mt-5 text-4xl font-bold">
                <p class="mb-0 mr-2">お会計額</p>
                <input class="form-input p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0 mr-2" type="text" id="amount">
                <p class="mb-0">円</p>
            </div>
            <p class="text-lg flex items-end justify-center  font-bold mt-10">割り勘人数は<input  id="totalMembers" class="text-right border border-gray-300" input class="peopleInput" type="number" min="1" max="{{ App\Models\Member::count() }}" value="{{ App\Models\Member::count() }}">人です(減らす場合は入力)</p>

            <div class="flex justify-center mt-5">
                <label class="text-lg flex items-center font-bold mr-4">
                    <input type="radio" id="evenSplit" name="sex" value="0" checked> 男女均等
                </label>
                <label class="text-lg flex items-center font-bold">
                    <input type="radio" id="womenLess" name="sex" value="1"> 女性少なめ
                </label>
            </div>
            <div>
                    <button id="calculate" class="mt-5 absolute left-1/2 transform -translate-x-1/2 px-20 py-4 bg-red-700 hover:bg-yellow-500 text-white text-2xl font-bold rounded">割り勘額確認！</button>
            </div>
               
             <div>
                <p class="text-4xl flex justify-center mt-32 font-bold">お会計は</p><br>
                <p class="text-lg font-bold flex justify-center" id="menAmount">男性 / 返答なし　　円</p>
                <p class="text-lg font-bold flex justify-center"  id="womenAmount">女性　　円</p>
                <p class="text-lg font-bold flex justify-center"  id="remainder">余剰金　円です</p>
                <p>（100円単位で切り上げるため、集めた合計金額がお会計よりも多くなることがあります。）</p><br>
            </div>  
            <div>
                <p class="text-lg flex items-end justify-center  font-bold mt-10">２次会の場所が決まっていれば伝えられます</p>
                <p class="text-lg flex items-end justify-center  font-bold">伝える場合は入力してください</p><br>
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
                    <button id="send-btn" class="mt-5 absolute left-1/2 transform -translate-x-1/2 px-20 py-4 bg-red-700 hover:bg-yellow-500 text-white text-2xl font-bold rounded" type="submit">みんなに送信！</button>
                    <meta name="csrf-token" content="{{ csrf_token() }}"><br><br>
                </div>
            </div>



    </div>
    
    <!-- ２次会入力画面 -->
    
    
      
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
        // 送信ボタンのJS
        document.getElementById('send-btn').addEventListener('click', function(e) {
            // 現在の時刻をローカルストレージに保存
            var currentTime = new Date().getTime();
            localStorage.setItem('startTime', currentTime);

            // その他のデータをローカルストレージに保存
            var eventPlace = document.getElementById('event_place').value;
            var placeUrl = document.getElementById('place_url').value;
            localStorage.setItem('eventPlace',eventPlace );
            localStorage.setItem('placeUrl', placeUrl);

            // サーバーにリクエストを送信してデータ削除を1時間後にスケジュール
            var eventId = 'event-id'; // 適切なイベントIDを設定してください。
            fetch('/schedule-deletion', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ event_id: eventId })
            })
            .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
            })
            .then(data => {
                // ここでデータを処理します。例えば、アラートを表示するなど:
                alert(data.message);
            })
            .catch(error => {
                // ここでエラーを処理します。例えば、コンソールにエラーメッセージを表示するなど:
                console.error('There has been a problem with your fetch operation:', error);
            });
        });

    </script>
    
</body>
</html>