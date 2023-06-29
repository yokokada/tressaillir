<!DOCTYPE html>
<html lang="ja">

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

<body>
    <div class="flex justify-center items-center min-w-screen flex-col">
        <div class="relative">
            <img src="{{ asset('img/nomoca.jpg') }}" class="w-full object-contain" alt="Top Image">
            <a href="#" class="absolute bottom-32 left-1/2 transform -translate-x-1/2 px-28 py-6 bg-white hover:bg-yellow-200 text-red-700 font-bold rounded">START</a>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>