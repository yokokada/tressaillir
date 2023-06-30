<!DOCTYPE html>
<html lang="jn">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    #image-preview img {
      width: 100%;
      height: auto;
    }
  </style>
</head>

<body>
  <header class="bg-red-700 p-3">
    <nav class="flex justify-between items-center">
      <div class="text-white text-lg font-bold">
        <h1>飲み会登録画面</h1>
      </div>
      <button id="menu-toggle" class="text-white p-2 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
          class="h-6 w-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </nav>
    <div id="menu" class="hidden py-2 flex flex-col items-end">
      <a href="#" class="block text-white px-4 py-2">メニュー項目1</a>
      <a href="#" class="block text-white px-4 py-2">メニュー項目2</a>
      <a href="/event-index" class="block text-white px-4 py-2">イベントリスト</a>
    </div>
  </header>

  <form action="{{ url('members') }}" method="post" class="container mx-auto p-14" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
      <!-- カラム１ -->
      <div class="col-span-2">
        <label class="nickname">
          あだ名
        </label>
        <input name="nickname"
          class="form-input p-2.5 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0"
          type="text" placeholder="">
      </div>
      <!-- カラム２ -->
      <div class="col-span-2">
        <label class="">
          アイコン
        </label>
        <input type="file" name="icon" accept="image/*" onchange="showFile(event)">
        <div id="image-preview" class="w-full"></div>
      </div>
      <!-- カラム4 -->
      <div class="col-span-2">
        <label class="">
          趣味
        </label>
        <input name="hobby"
          class="form-input p-2.5 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0"
          type="text" placeholder="">
      </div>
      <!-- カラム5 -->
      <div class="col-span-2">
        <label class="">
          ファーストドリンク
        </label>
        <select name="firstdrink" id=""
          class="form-input p-2.5 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border border-gray-400 focus:border-red-600 focus:ring-0">
          <option value="0">生ビール</option>
          <option value="1">瓶ビール</option>
          <option value="2">ノンアルコールビール</option>
          <option value="3">ハイボール</option>
          <option value="4">レモンサワー</option>
          <option value="5">ウーロンハイ</option>
          <option value="6">緑茶ハイ</option>
          <option value="7">烏龍茶</option>
          <option value="8">コーラ</option>
          <option value="9">ジンジャーエール</option>
          <option value="10">その他</option>
        </select>
      </div>

      <div class="">
        <label class="">
          性別
          <label for="">
            <input type="radio" name="sex" value="0">男性
          </label>
          <label for="">
            <input type="radio" name="sex" value="1">女性
          </label>
          <label for="">
            <input type="radio" name="sex" value="2">答えない
          </label>
        </label>
      </div>
      <!-- 送信ボタン -->
      <div class="">
        <div class="">
          <input name="event_id" type="hidden" value="{{ $id }}">
          <button
            class="mt-14 absolute left-1/2 transform -translate-x-1/2 px-20 py-4 bg-red-700 hover:bg-yellow-500 text-white text-2xl font-bold rounded"
            type="submit">送信</button>
        </div>
      </div>
    </div>
  </form>

  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');

    menuToggle.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });

    function showFile(event) {
      const file = event.target.files[0];
      const reader = new FileReader();

      reader.onload = function (e) {
        const imagePreview = document.getElementById('image-preview');
        const image = document.createElement('img');
        image.src = e.target.result;
        image.classList.add('rounded-icon');
        imagePreview.innerHTML = '';
        imagePreview.appendChild(image);
      };

      reader.readAsDataURL(file);
    }
  </script>
</body>
</html>