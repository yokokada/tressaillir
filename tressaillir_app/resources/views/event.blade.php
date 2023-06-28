<!DOCTYPE html>
<html lang="jn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>飲み会前画面</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<!-- 飲み会情報を表示-->
<div id="events-container">
    @foreach ($events as $event)
        <div>
            <p class="text-lg">{{ $event->event }}</p><br>
            <p class="text-lg">{{ $event->date }}</p><br>
            <p class="text-lg">{{ $event->event_place }}</p><br>
            <p class="text-lg">{{ $event->place_url }}</p>
        </div>
    @endforeach
</div>

<!-- 飲み会参加者のアイコンと名前を表示 -->
<div id="members-container" class="grid grid-cols-2 gap-4">
    @foreach ($members as $member)
        <div class="flex items-center flex-col">
            <p class="text-lg">{{ $member->nickname }}</p>
            <img src="{{ asset($member->icon) }}" class="w-16 h-16 rounded-full mr-4">
        </div>
    @endforeach
</div>
</body>
</html>