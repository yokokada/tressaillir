// 振り分けボタンを押すと、人数を振り分け
var distributeButton = document.getElementById('distributeButton');
distributeButton.addEventListener('click', function() {
  // 総人数をfetch()関数を使用して取得
  fetch('/api/members/total')
  .then(response => response.json())
  .then(data => {
      const total = data.total;
      console.log('総人数:', total);
      // ここで必要な処理を行う
  })
  .catch(error => {
      console.error('リクエストエラー:', error);
  });

  var peopleInputs = document.getElementsByClassName('peopleInput');
  var peopleCounts = [];
  var sum = 0;

  for (var i = 0; i < peopleInputs.length; i++) {
    var peopleInput = peopleInputs[i];
    var peopleCount = parseInt(peopleInput.value);
    peopleCounts.push(peopleCount);
    sum += peopleCount;
    console.log(sum);
  }
  //  sumは総人数
  if (sum !== total) {
    alert('入力された人数の合計が総人数と一致しません。');
    return;
  }
 
 // HTML要素の取得
  var container = document.getElementById("memberContainer");
  var members = Array.from(container.getElementsByClassName("member"));

  // メンバー要素をシャッフル
  shuffleArray(members);

  
  var resultContainer = document.getElementById('resultContainer');
  resultContainer.innerHTML = '';
  // 上記が結果表示の部分 


  var nameIndex = 0;
  for (var i = 0; i < peopleCounts.length; i++) {
    var peopleCount = peopleCounts[i];
    var machineNumber = i + 1;

   // 机
    var desk = document.createElement('div');
    desk.className = 'desk';

    for (var j = 0; j < peopleCount; j++) {
      if (nameIndex >= shuffledNames.length) {
        nameIndex = 0;
      }
     // 椅子
      var chair = document.createElement('div');
      chair.className = 'chair';

      var nameLabel = document.createElement('div');
      nameLabel.className = 'name-label';
      nameLabel.innerHTML = shuffledNames[nameIndex];

      chair.appendChild(nameLabel);
      desk.appendChild(chair);

      nameIndex++;
    }

    resultContainer.appendChild(desk);
  }
});

// 振り分け配列
function shuffleArray(array) {
  var currentIndex = array.length;
  var temporaryValue;
  var randomIndex;

  while (0 !== currentIndex) {
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}