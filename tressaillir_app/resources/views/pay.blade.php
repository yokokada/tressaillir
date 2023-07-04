<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お会計画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body >
    <header class="bg-red-600 p-3">
        <nav class="flex justify-between items-center">
            <h1 class="text-white font-bold">
                 <p>{{ $event_title->event->event }}</p> 
            </h1>
        </nav>
    </header>

<!--------------- 会計入力画面 ---------------------->
<!-- 会計入力 -->
<div class="flex flex-col items-center text-gray-700" style="text-align: center;">
    <div class="container mx-auto p-8" style="text-align: center;">
        @csrf
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2" style="text-align: center;">
            <div class="col-span-2">
                <label class="block text-lg">
                    お会計額
                    <div class="flex items-center">
                        <input name="event" class="form-input p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0" type="text" id="amount" placeholder="">
                        <span class="ml-2">円</span>
                    </div>
                </label>
            </div>
            <div>
                <label class="block">
                    <p class="text-lg flex justify-center">割り勘人数は<input id="totalMembers" class="border border-gray-400 rounded-lg px-2 py-1" input class="peopleInput" type="number" min="1" max="{{ $total }}" value="{{ $total }}">人です</p>
                    <p class="text-xs flex justify-center">※減らす場合は入力</p>
                    {{-- <input name="date" class="form-input p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0" type="date" placeholder=""> --}}
                </label>
            </div>
            <div class="col-span-2">
                <label class="block">
                    <div class="flex justify-center">
                        <label class="text-lg flex items-center mr-4">
                            <input type="radio" id="evenSplit" name="sex" value="0" checked> 男女均等
                        </label>
                        <label class="text-lg flex items-center ">
                            <input type="radio" id="womenLess" name="sex" value="1"> 女性少なめ
                        </label>
                    </div>
                </label>
            </div>
            <div class="col-span-2">
                <button id="calculate" class="w-full py-2 bg-red-600 hover:bg-yellow-400 text-white text-xl font-bold rounded-lg mt-2">割り勘額確認！</button>
                <p class="text-2xl flex justify-center font-bold mt-4">お会計は</p>
                <p class="text-lg font-bold flex justify-center mt-2" id="menAmount">男性 / 返答なし　　円</span></p>
                <p class="text-lg font-bold flex justify-center" id="womenAmount">女性　　円</span></p>
                <p class="text-lg font-bold flex justify-center" id="remainder">余剰金　円</span>です</p>
                <p class="text-xs mt-2">※100円単位で切り上げるため、集めた合計金額がお会計よりも多くなることがあります。</p>
              </div>

            <div class="col-span-2 mt-8">
                <p class="text-lg flex justify-center font-bold">２次会の場所が決まっていれば、入力してください。</p>
                <label class="block mt-2">
                    店名
                    <input id="event_place" class="form-input p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0" type="text" placeholder="">
                </label>
            </div>
            <div class="col-span-2">
                <label class="block">
                    マップURL
                    <input id="place_url" class="form-input p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0" type="text" placeholder="">
                </label>
            </div>
            <div class="col-span-2">
                <button id="send-btn" class="w-3/4 py-2 bg-red-600 hover:bg-yellow-400 text-white text-xl font-bold rounded-lg mt-2" type="submit">みんなに送信！</button>
                <meta name="csrf-token" content="{{ csrf_token() }}">
            </div>
        </div>  
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

            // // サーバーにリクエストを送信してデータ削除を1時間後にスケジュール
            // var eventId = 'event-id'; // 適切なイベントIDを設定してください。
            // fetch('/schedule-deletion', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            //     },
            //     body: JSON.stringify({ event_id: eventId })
            // })
            // .then(response => {
            // if (!response.ok) {
            //     throw new Error('Network response was not ok');
            // }
            // return response.json();
            // })
            // .then(data => {
            //     // ここでデータを処理します。例えば、アラートを表示するなど:
            //     alert(data.message);
                 // クリックイベントが完了した後にページ遷移を行います。
                 var eventId = "{{ $event_title->event->id }}"; // 適切なイベントIDを設定してください。
                 var eventHash = "{{ $event_title->event->hash }}"; // 適切なイベントIDを設定してください。
                 console.log(eventId)
                 window.location.href = "/close/" +  eventId + "/" + eventHash;
                //  window.location.href = "/close/" +  eventId;
            });
           
    
        //     .catch(error => {
        //         // ここでエラーを処理します。例えば、コンソールにエラーメッセージを表示するなど:
        //         console.error('There has been a problem with your fetch operation:', error);
        //     });
        // });

    </script>
    
</body>
</html>