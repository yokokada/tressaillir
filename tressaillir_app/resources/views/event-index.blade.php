<!DOCTYPE html>
<html lang="jp">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <h1>登録イベント一覧</h1>
  @foreach ($events as $event)
  <div class="flex items-center flex-col">
    <a href="event-detail/{{ $event->id }}"><p class="text-lg">{{ $event->event }}</p></a>
    {{-- <a href="event-detail/id={{ $event->id }}"><p class="text-lg">{{ $event->event }}</p></a> --}}
  </div>
  @endforeach
  <a href="/event-cordinator">戻る</a>
</body>
</html>