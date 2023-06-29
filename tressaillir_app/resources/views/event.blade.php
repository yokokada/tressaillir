<!DOCTYPE html>
<html lang="jn">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>飲み会前画面</title>
  <style>
    .hidden {display: none;}
  </style>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class=text-red-700>
  <header class="bg-red-700 p-3">
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
      <a href="#" class="block text-white px-4 py-2">メニュー項目1</a>
      <a href="#" class="block text-white px-4 py-2">メニュー項目2</a>
      <a href="#" class="block text-white px-4 py-2">メニュー項目3</a>
    </div>
  </header>
  
  @if (session('registrationCompletedMessage'))
  <div class="registrationCompletedMessage text-green-600 font-bold text-center">
    {{ session('registrationCompletedMessage') }}
  </div>
  @endif

  <!-- 飲み会情報を表示 -->
  <div id="events-container" class="mt-7 flex justify-center">
    <div>
      <p class="text-lg flex justify-center">日程</p>
      <p class="text-4xl font-bold mb-5 flex justify-center">{{ $event->date }}</p>
      <p class="text-lg flex justify-center">時間</p>
      <p class="text-4xl font-bold mb-5 flex justify-center">{{ $event->time }}</p>
      <p class="text-lg flex justify-center">お店の名前</p>
      <p class="text-4xl font-bold mb-5 flex justify-center">{{ $event->event_place }}</p>
      <p class="text-lg flex justify-center">住所</p>
      <p class="text-xl font-bold mb-5 flex justify-center">{{ $event->place_url }}</p>
    </div>
  </div>

  <!-- 飲み会参加者のアイコンと名前を表示 -->
  <p class="text-xl font-bold mt-7 flex justify-center">参加者一覧</p>
  <div id="members-container" class="grid grid-cols-4 gap-1 mt-2 bg-red-700 pt-7">
    @foreach ($event->members as $member)
    <div class="flex items-center justify-center flex-col">
      <img src="{{ asset($member->icon) }}" class="w-20 h-20 rounded-full mb-1">
      <p class="text-lg font-bold mb-7 text-white">{{ $member->nickname }}</p>
    </div>
    @endforeach
  </div>
  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');
  
    menuToggle.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>
</body>
</html>