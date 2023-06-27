<!DOCTYPE html>
<html lang="jn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>飲み会前画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<!-- 飲み会情報をevent-showをそのまま表示-->
<x-event-component :events="$events" />
<!-- 飲み会参加者のアイコンと名前を表示 -->
<x-member-component :members="$members" />
</div>
</body>
</html>