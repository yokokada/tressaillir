<!-- MemberComponent.blade.php -->
<div id="members-container" class="grid grid-cols-2 gap-4">
    @foreach ($members as $member)
    <div class="flex items-center flex-col">
        <p class="text-lg">{{ $member->nickname }}</p>
        <img src="{{ asset($member->icon) }}" class="w-16 h-16 rounded-full mr-4">
    </div>
    @endforeach
</div>