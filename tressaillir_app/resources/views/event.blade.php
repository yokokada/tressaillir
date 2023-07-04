<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class=text-red-600>
  <header class="bg-red-600 p-3">
    <nav class="flex justify-between items-center">
      <div class="text-white text-lg font-bold">
          <p>{{ $event->event }}</p>
      </div>
      <button id="menu-toggle" class="text-white p-2 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </nav>
    <div id="menu" class="hidden py-2 flex flex-col items-end">
      <a href="/event-index" class="block text-white px-4 py-2">イベントリスト</a>
      <a href="/" class="block text-white px-4 py-2">ログアウト</a>
    </div>
  </header>
  
  @if (session('registrationCompletedMessage'))
  <div class="registrationCompletedMessage text-green-600 font-bold text-center">
    {{ session('registrationCompletedMessage') }}
  </div>
  @endif

<!-- 飲み会情報を表示 -->
<div id="events-container" class="flex justify-center mx-auto p-8">
  <div>
    <p class="text-lg flex justify-center">日程</p>
    <p class="text-4xl font-bold mb-5 flex justify-center">{{ $event->date }}</p>
    <p class="text-lg flex justify-center">時間</p>
    <p class="text-4xl font-bold mb-5 flex justify-center">{{ $event->time }}</p>
    <p class="text-lg flex justify-center">お店の名前</p>
    <p class="text-4xl font-bold mb-5 flex justify-center">{{ $event->event_place }}</p>
    <p class="text-lg flex justify-center">住所</p>
    <p class="text-xl font-bold flex justify-center">
      <a href="{{ $event->place_url }}">
        {{ $event->place_url }}
      </a>
    </p>
  </div>
</div>

<!-- 飲み会参加者のアイコンと名前を表示 -->
<p class="text-xl font-bold text-gray-700 flex justify-center">参加者一覧</p>
<div id="members-container" class="grid grid-cols-4 gap-1 mt-2 bg-gray-200 p-5">
  @foreach ($event->members as $member)
  <div class="flex items-center justify-center flex-col">
    <img src="{{ asset($member->icon) }}" class="w-20 h-20 rounded-full mb-1">
    <p class="text-lg font-bold text-gray-700">{{ $member->nickname }}</p>
  </div>
  @endforeach
</div>

<!-- 飲み会開始ボタン -->
<div class="mt-8 flex justify-center">
  <button id="start-btn" class="px-10 py-4 bg-red-600 hover:bg-yellow-400 text-white text-2xl font-bold rounded-xl" type="submit">
    飲み会開始！
  </button>
</div>

<div class="mt-8"></div>

  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');
  
    menuToggle.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>
  <script>
    // 開始ボタンのJS
document.getElementById('start-btn').addEventListener('click', function(e) {
    // クリックイベントが完了した後にページ遷移を行います。
    var eventId = "{{ $event->id }}"; // 画面上の適切なイベントIDを設定してください。
    window.location.href = "/index/" + eventId;
});
  </script>
</body>
</html>