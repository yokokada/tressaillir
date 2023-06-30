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
    <div>
        <h1>会計額</h1><br>
        <input type="text" class="text-right border border-gray-300" onblur="kanmaChange(this);" pattern="\d*">円<br><br>
        <p class=""> 総人数は{{ App\Models\Member::count() }}人です。</p><br>
        <p>割り勘人数は<input  class="text-right border border-gray-300" input class="peopleInput" type="number" min="1" max="{{ App\Models\Member::count() }}" value="{{ App\Models\Member::count() }}">人です</p>

        <p>割り方オプション</p>
        <label for=""><input type="radio" name="sex" value="0">男女均等</label>
        <label for=""><input type="radio" name="sex" value="1">女性少なめ</label><br><br>
        <button type="submit" class="text-right border border-gray-300">割り勘額確認！</button><br><br>
    </div>


    <!-- ２次会入力画面 -->
    <div>
        <p>２次会について</p>
        <p>２次会の場所が決まっていれば伝えられます</p>
        <p>伝える場合は入力してください</p><br>
        <div class="col-span-2">
            <label class="block">
            店名
            <input name="event_place" class="form-input p-2.5 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0" type="text" placeholder="">
            </label>
        </div>
        <div class="col-span-2">
            <label class="block">
            マップURL
            <input name="place_url" class="form-input p-2.5 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0" type="text" placeholder="">
            </label>
        </div>
        <div class="col-span-2">
            <button class="mt-14 absolute left-1/2 transform -translate-x-1/2 px-20 py-4 bg-red-700 hover:bg-yellow-500 text-white text-2xl font-bold rounded" type="submit">登録</button>
        </div>
        

    </div>
    


    <script>
        function kanmaChange(inputAns){
        console.log(inputAns);
        let inputAnsValue = inputAns.value;
        console.log(inputAnsValue);
        let numberAns = inputAnsValue.replace(/[^0-9]/g, "");
        kanmaAns = numberAns.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
        console.log(kanmaAns);
        if(kanmaAns.match(/[^0-9]/g)){
        inputAns.value= kanmaAns;
        return true;
        }
        };
    </script>
    
</body>
</html>