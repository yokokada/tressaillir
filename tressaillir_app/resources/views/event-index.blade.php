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
        <h1>登録イベント一覧</h1>
      </div>
      <button id="menu-toggle" class="text-white p-2 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </nav>
    <div id="menu" class="hidden py-2 flex flex-col items-end">
      <a href="/event-cordinator" class="block text-white px-4 py-2">イベント登録</a>
      <a href="/" class="block text-white px-4 py-2">ログアウト</a>
    </div>
  </header>

  @foreach ($events as $event)
  <form action="{{ url('event-register') }}" method="post" class="container mx-auto p-14">
    @csrf
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
      <a href="create/{{ $event->id }}/{{ $event->hash }}">
        <p class="text-l font-medium ">{{ $event->date }} {{ $event->time }}</p>
        <h1 class="mt-2 text-4xl font-bold ">{{ $event->event }}</h1>
      </a>
      <div class="relative">
        <input name="event"
          class="form-input p-2.5 w-full text-black bg-white rounded border border-gray-400 focus:border-red-600 focus:ring-0"
          type="text" value="{{ url("/welcome/{$event->id}/{$event->hash}") }}" readonly>
      </div>
      <button onclick="event.preventDefault(); copyToClipboard('{{ url("/welcome/{$event->id}/{$event->hash}") }}')"
        class="bg-red-600 w-full px-4 py-2 text-white rounded">招待URL コピー</button>
  </form>
  </div>
  @endforeach

  <script>
    function copyToClipboard(text) {
      const el = document.createElement('textarea');
      el.value = text;
      document.body.appendChild(el);
      el.select();
      document.execCommand('copy');
      document.body.removeChild(el);
      alert('クリップボードにコピーしました！');
    }

    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');
  
    menuToggle.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>
</body>

</html>