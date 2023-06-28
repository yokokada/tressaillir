<!DOCTYPE html>
<html lang="jn">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <h1>飲み会情報登録画面</h1>
  <form action="{{ url('event-register') }}" method="post" class="">
    @csrf
    <div class="">
      <div class="">
        <label class="">
          題名
        </label>
      <input name="event" class="" type="text" placeholder="">

      <!-- カラム4 -->
      <div class="">
        <label class="">
          日程
        </label>
      <input name="date" class="" type="date" placeholder="">
      </div>
      <div class="">
        <label class="">
          時間
        </label>
        <input name="time" class="" type="time" placeholder="">
      </div>
        <label class="">
          店名
        </label>
        <input name="event_place" class="" type="text" placeholder="">
      </div>

      <div class="">
        <label class="">
          マップURL
        </label>
        <input name="place_url" class="" type="text" placeholder="">
      </div>

      <!-- 送信ボタン -->
      <div class="">
        <div class="">
          <button class="" type="submit">送信</button>
        </div>
      </div>
    </div>
  </form>
  <div>
    <a href="/event-index">イベントリスト</a>
  </div>
</body>
</html>