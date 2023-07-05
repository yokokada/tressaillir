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
            <video autoplay loop muted class="w-full object-cover">
                <source src="{{ asset('video/Nomoca_welcome.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <a href="{{ url("/create/{$param1}/{$param2}") }}"
                class="absolute bottom-24 left-1/2 transform -translate-x-1/2 px-12 py-4 bg-white hover:bg-yellow-400 text-red-600 font-bold text-2xl rounded-2xl">START</a>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        var param1 = "{{ session('param1') }}";
        var param2 = "{{ session('param2') }}";
    </script>
</body>

</html>