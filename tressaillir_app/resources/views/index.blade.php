@foreach ($members as $member)
<p>ニックネーム：{{ $member->nickname }}</p>
<img src="{{ asset($member->icon) }}">
@endforeach

<p>test</p>