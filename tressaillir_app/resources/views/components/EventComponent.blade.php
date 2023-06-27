<!-- EventComponent.blade.php -->
<div>
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
</div>