// 行追加ボタンのクリックイベントリスナーを追加
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(event) {
      if (event.target.classList.contains('add-button')) {
        event.preventDefault();
  
        var container = document.getElementById('container');
        var row = document.querySelector('#container .table-container');
        var newRow = row.cloneNode(true);
        newRow.innerHTML = newRow.innerHTML.replace('テーブル1', 'テーブル' + (container.children.length + 1));
        container.appendChild(newRow);
      }
    });
  });
  
  
    // removeボタンのクリックイベントを処理
    document.addEventListener('click', function(event) {
      if (event.target.classList.contains('remove-button')) {
        event.preventDefault();
        // 対応するテーブルを削除
        var container = document.getElementById('container');
        if (container.children.length > 1) { // Don't remove if only one .table-container left
          container.removeChild(container.lastElementChild);
        }
      }
    });
 
  
