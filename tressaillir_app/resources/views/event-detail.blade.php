<!DOCTYPE html>
<html lang="jp">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <div class="text-center">
    <p class="text-2xl font-bold">{{ $event->event }}</p>
    <p>{{ $event->event_place }}</p>
    <p>{{ $event->id }}</p>
    <button>招待URL作成</button>
    <p>{{ url("/create/{$event->id}") }}
    <p>{{ route('participantsForm',[$event->event . "&" .  $event->id]); }}</p>
    {{-- <p>{{ route('participantsForm', [$event->id]); }}</p> --}}
  </div>
  <a href="/event-index">戻る</a>
</body>

</html>