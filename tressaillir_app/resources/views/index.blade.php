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

<div id="members-container">
    @foreach ($members as $member)
        <div>
            <p>ニックネーム：{{ $member->nickname }}</p>
            <img src="{{ asset($member->icon) }}">
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
