// 指定した色のリストを作成
var colorList = ["#64cded", "#FCD34D", "#22C65F", "#fa6161"];

var colorIndex = 0; // 新たに色のインデックスを管理する変数を追加

// 現在のURLからevent_idを取得
const urlSegments = window.location.pathname.split("/");
const eventId = urlSegments[urlSegments.length - 1];

function getNextColor() {
    var color = colorList[colorIndex];
    colorIndex = (colorIndex + 1) % colorList.length; // 色のインデックスを更新
    return color;
}

    // ブロードキャストイベントを受信
    window.Echo.channel('seating-arrangement.' + eventId)
        .listen('.arrangement-updated', (data) => {
        // 席決め後の処理を実行
        // 他の参加者の画面を更新するコードを追加
        // 例: 画面をリロードするか、必要なデータを再取得してDOMを更新する
    });

// 振り分けボタンを押すと、人数を振り分け
var distributeButton = document.getElementById("distributeButton");
distributeButton.addEventListener("click", function () {
    // 総人数をfetch()関数を使用して取得
    // fetch("/api/members/total")
    const pathParts = window.location.pathname.split("/");
    const indexNumber = pathParts[2];
    //?の後ろにクエリパラメータを準備(event_id)
    fetch(`/api/members/total?event_id=${indexNumber}`)
        .then((response) => response.json())
        .then((data) => {
            const total = data.total;
            console.log("総人数:", total);

            var peopleInputs = document.getElementsByClassName("peopleInput");
            var peopleCounts = [];
            var sum = 0;

            for (var i = 0; i < peopleInputs.length; i++) {
                var peopleInput = peopleInputs[i];
                var peopleCount = parseInt(peopleInput.value);
                peopleCounts.push(peopleCount);
                sum += peopleCount;
            }

            console.log(sum);

            if (sum !== total) {
                alert("入力された人数の合計が総人数と一致しません。");
                return;
            }

            var container = document.getElementById("members-container");
            var members = Array.from(
                document.querySelectorAll("#members-container > div")
            );

            // メンバーの並び順をシャッフル
            for (var i = members.length - 1; i > 0; i--) {
                var j = Math.floor(Math.random() * (i + 1));
                var temp = members[i];
                members[i] = members[j];
                members[j] = temp;
            }
            // Update the DOM based on the shuffled members array
            container.innerHTML = "";
            for (var i = 0; i < members.length; i++) {
                container.appendChild(members[i]);
            }

            // テーブルごとに色を設定
            var startIndex = 0;
            for (var i = 0; i < peopleCounts.length; i++) {
                var tableColor = getNextColor(); // 指定した色を取得

                // テーブル要素を取得
                var tableContainer = document.querySelector(
                    "#container > .table-container:nth-child(" + (i + 1) + ")"
                );

                // テーブル要素に背景色を設定
                tableContainer.style.backgroundColor = tableColor;

                // テーブルに所属するメンバーの数に応じて色を設定
                for (var j = 0; j < peopleCounts[i]; j++) {
                    var memberElement = members[startIndex + j];
                    var nicknameElement =
                        memberElement.querySelector(".text-lg");

                    // メンバーの要素を四角で囲むためのスタイルを設定
                    nicknameElement.style.border = "4px solid " + tableColor;
                    nicknameElement.style.borderRadius = "7px";
                    nicknameElement.style.padding = "5px";
                }

                // 次のテーブルのメンバーの開始インデックスを更新
                startIndex += peopleCounts[i];
                
            }
        })
        .catch((error) => {
            console.error("リクエストエラー:", error);
        });
});
