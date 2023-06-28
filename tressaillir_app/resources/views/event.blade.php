<!DOCTYPE html>
<html lang="jn">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>飲み会前画面</title>
  <!-- Noto Sansのフォントを追加 -->
  <style>
  </style>
  <!-- Tailwind CSSのリンク -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class=text-red-700>
  <header class="bg-red-700 p-3">
    <nav class="flex justify-between items-center justify-center">
        @foreach ($events as $event)
        <div>
          <p class="text-lg font-bold text-white ">{{ $event->event }}</p>
        </div>
        @endforeach
    </nav>
  </header>

  <!-- 飲み会情報を表示 -->
  <div id="events-container" class="mt-7 flex justify-center">
    @foreach ($events as $event)
    <div>
      開始日時
      <p class="text-4xl font-bold mb-3">{{ $event->date }}</p>
      店の名前
      <p class="text-4xl font-bold mb-3">{{ $event->event_place }}</p>
      住所
      <p class="text-4xl font-bold mb-3">{{ $event->place_url }}</p>
    </div>
    @endforeach
  </div>

  <!-- 飲み会参加者のアイコンと名前を表示 -->
  <p class="text-xl font-bold mt-7 flex justify-center">参加者一覧</p>
  <div id="members-container" class="grid grid-cols-4 gap-1 mt-2 bg-red-700 pt-7">
    @foreach ($members as $member)
    <div class="flex items-center justify-center flex-col">
      <img src="{{ asset($member->icon) }}" class="w-20 h-20 rounded-full mb-1">
      <p class="text-lg font-bold mb-7 text-white">{{ $member->nickname }}</p>
    </div>
    @endforeach
  </div>
</body>

</html>