<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

  <header class="bg-red-700 p-3">
    <nav class="flex justify-between items-center">
      <div class="text-white text-lg font-bold">
        <h1>飲み会登録画面</h1>
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
      <a href="/event-index" class="block text-white px-4 py-2">イベントリスト</a>
    </div>
  </header>

  <form action="{{ url('event-register') }}" method="post" class="container mx-auto p-14">
    @csrf
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
      <div class="col-span-2">
        <label class="block">
          飲み会名
          <input name="event" class="form-input p-2.5 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0" type="text" placeholder="">
        </label>
      </div>
      <div>
        <label class="block">
          日程
          <input name="date" class="form-input p-2.5 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0" type="date" placeholder="">
        </label>
      </div>
      <div>
        <label class="block">
          時間
          <input name="time" class="form-input p-2.5 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0" type="time" placeholder="">
        </label>
      </div>
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
  </form>
  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');
  
    menuToggle.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>
</body>
</html>
