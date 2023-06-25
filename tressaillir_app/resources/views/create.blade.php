<!DOCTYPE html>
<html lang="jn">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="{{ url('members') }}" method="post" class="">
    @csrf
    <div class="">
      <!-- カラム１ -->
      <div class="">
        <label class="nickname">
          あだ名
        </label>
        <input name="nickname" class="" type="text" placeholder="">
      </div>
      <!-- カラム２ -->
      <div class="">
        <label class="">
          アイコン
        </label>
        <input type="file" name="icon" accept="image/*">
      </div>
      <!-- カラム4 -->
      <div class="">
        <label class="">
          趣味
        </label>
        <input name="hobby" class="" type="text" placeholder="">
      </div>
      <!-- カラム4-->
      <div class="">
        <label class="">
          性別
          <div class="">
            <span class=""></span>
            <div>
              <label for="">
                <input type="radio" name="sex" value="0">男性
              </label>
              <label for="">
                <input type="radio" name="sex" value="1">女性
              </label>
              <label for="">
                <input type="radio" name="sex" value="2">答えない
              </label>
            </div>
          </div>
      </div>
      <!-- カラム5 -->
      <div class="">
        <label class="">
          ファーストドリンク
        </label>
        <select name="firstdrink" id="">
          <option value="0">生ビール</option>
          <option value="1">瓶ビール</option>
          <option value="2">ノンアルコールビール</option>
          <option value="3">ハイボール</option>
          <option value="4">レモンサワー</option>
          <option value="5">ウーロンハイ</option>
          <option value="6">緑茶ハイ</option>
          <option value="7">烏龍茶</option>
          <option value="8">コーラ</option>
          <option value="9">ジンジャーエール</option>
          <option value="10">その他</option>
        </select>
      </div>
      <!-- 送信ボタン -->
      <div class="">
        <div class="">
          <button class="" type="submit">送信</button>
        </div>
      </div>
    </div>
  </form>
</body>

</html>