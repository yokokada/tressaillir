<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class=text-red-700>
  <header class="bg-red-700 p-3">
    <nav class="flex justify-between items-center">
      <div class="text-white text-lg font-bold">
        <h1>登録イベント一覧</h1>
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
      <a href="/event-cordinator" class="block text-white px-4 py-2">戻る</a>
    </div>
  </header>

  @foreach ($events as $event)
  <div class="mt-7 ml-14 flex justify-start hover:bg-yellow-200">
    {{-- <a href="event-detail/{{ $event->id }}"> --}}
    <a href="event/{{ $event->id }}">
      <p class="text-2xl font-medium mt-7">{{ $event->date }}　{{ $event->time }}</p>
      <h1 class="mt-4 text-6xl font-bold ">{{ $event->event }}</h1>
      <p>{{ url("/create/{$event->id}") }}</p>
    </a>
    {{-- <a href="event-detail/id={{ $event->id }}">
      <p class="text-lg">{{ $event->event }}</p>
    </a> --}}
  </div>
  @endforeach

  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');
  
    menuToggle.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>
</body>

</html>