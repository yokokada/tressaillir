@foreach ($members as $member)
<p>ニックネーム：{{ $member->nickname }}</p>
<img src="{{ asset('img/defo_img.png') }}" alt="">
{{-- <img src="{{ asset('img/defo_img.png') }}" alt=""> --}}
@endforeach

<p>test</p>