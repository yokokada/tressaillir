<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
<div id="members-container" class="grid grid-cols-2 gap-4">
    @foreach ($members as $member)
    <div class="flex items-center flex-col">
        <p class="text-lg">{{ $member->nickname }}</p>
        <img src="{{ asset($member->icon) }}" class="w-16 h-16 rounded-full mr-4">
    </div>
    @endforeach
</div>

<button onclick="seatChange()">席決めスタート</button>
<script>
    function seatChange() {
        var container = document.getElementById('members-container');
        var members = Array.prototype.slice.call(container.children); // メンバー要素の配列を作成

        // 配列をシャッフル
        for (var i = members.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var temp = members[i];
            members[i] = members[j];
            members[j] = temp;
        }

        // シャッフル後のメンバー要素をコンテナに追加
        for (var i = 0; i < members.length; i++) {
            container.appendChild(members[i]);
        }
    }
</script>
</body>

</html>
{{-- @foreach ($members as $member)
<p>ニックネーム：{{ $member->nickname }}</p>
<img src="{{ asset($member->icon) }}">
@endforeach

<div id=members-container></div>

<button onclick="seatChange()">席決めスタート</button>

<script>
    function seatChange() {
        var container = document.getElementById('members-container');
        var members = Array.prototype.slice.call(container.children); // メンバー要素の配列を作成

        // 配列をシャッフル
        for (var i = members.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var temp = members[i];
            members[i] = members[j];
            members[j] = temp;
        }

        // シャッフル後のメンバー要素をコンテナに追加
        for (var i = 0; i < members.length; i++) {
            container.appendChild(members[i]);
        }
    }
</script> --}}

{{-- <div id="members-container">
    @foreach ($members as $member)
    <div>
        <p class="text-2xl">ニックネーム：{{ $member->nickname }}</p>
        <img src="{{ asset($member->icon) }}">
    </div>
    @endforeach
    <!-- 参加人数のカウント -->
    <p>{{ count($members) }}</p>
</div>

<button onclick="seatChange()">席決めスタート</button>

<script>
    function seatChange() {
        var container = document.getElementById('members-container');
        var members = Array.prototype.slice.call(container.children); // メンバー要素の配列を作成
        // 配列をシャッフル
        for (var i = members.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            var temp = members[i];
            members[i] = members[j];
            members[j] = temp;
        }

        // シャッフル後のメンバー要素をコンテナに追加
        for (var i = 0; i < members.length; i++) {
            container.appendChild(members[i]);
        }
    } --}}



    

