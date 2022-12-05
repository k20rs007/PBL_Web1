<div class="rst_add">
  <h2>店舗登録</h2>
  <table>
    <tr>
        <td>店舗名</td>
        <td><input type="text"></td>
    </tr>
    <tr>
        <td>店舗画像</td>
        <td><input type="file"></td>
        <td><input type="file"></td>
        <td><input type="file"></td>
    </tr>
    <tr>
        <td>時間(平日)</td>
        <td><select name="time">
          <?php
            for($num = 0; $num <= 24; $num++) {
              if($num<10) {
                $a = 0;
              } else {
                $a = "";
              }
              echo '<option>'.$a.$num.'</option>';
            }
          ?>
        <td>:</td>
        </td>
        <td><select name="time">
          echo '<option>00</option>';
          <?php
            for($num = 1; $num <= 59; $num++) {
              if($num<10) {
                $a = 0;
              } else {
                $a = "";
              }
              echo '<option>'.$a.$num.'</option>';
            }
          ?>
        </td>
        <td>~</td>
        <td><select name="time">
          <?php
            for($num = 0; $num <= 24; $num++) {
              if($num<10) {
                $a = 0;
              } else {
                $a = "";
              }
              echo '<option>'.$a.$num.'</option>';
            }
          ?>
        <td>:</td>
        </td>
        <td><select name="time">
          echo '<option>00</option>';
          <?php
            for($num = 1; $num <= 59; $num++) {
              if($num<10) {
                $a = 0;
              } else {
                $a = "";
              }
              echo '<option>'.$a.$num.'</option>';
            }
          ?>
        </td>
    </tr>
    <tr>
        <td>時間(休日)</td>
        <td><select name="time">
          <?php
            for($num = 0; $num <= 24; $num++) {
              if($num<10) {
                $a = 0;
              } else {
                $a = "";
              }
              echo '<option>'.$a.$num.'</option>';
            }
          ?>
        <td>:</td>
        </td>
        <td><select name="time">
          echo '<option>00</option>';
          <?php
            for($num = 1; $num <= 59; $num++) {
              if($num<10) {
                $a = 0;
              } else {
                $a = "";
              }
              echo '<option>'.$a.$num.'</option>';
            }
          ?>
        </td>
        <td>~</td>
        <td><select name="time">
          <?php
            for($num = 0; $num <= 24; $num++) {
              if($num<10) {
                $a = 0;
              } else {
                $a = "";
              }
              echo '<option>'.$a.$num.'</option>';
            }
          ?>
        <td>:</td>
        </td>
        <td><select name="time">
          echo '<option>00</option>';
          <?php
            for($num = 1; $num <= 59; $num++) {
              if($num<10) {
                $a = 0;
              } else {
                $a = "";
              }
              echo '<option>'.$a.$num.'</option>';
            }
          ?>
        </td>
    </tr>
    <tr>
        <td>電話番号</td>
        <td><input type="text"></td>
        <td>-</td>
        <td><input type="text"></td>
        <td>-</td>
        <td><input type="text"></td>
    </tr>
    <tr>
        <td>値段目安</td>
        <td><input type="text"></td>
        <td>~</td>
        <td><input type="text"></td>
    </tr>
    <tr>
        <td>ジャンル</td>
        <?php
          $genre = [
            '和食',
            '洋食',
            'アジア',
            'カレー',
            '焼肉',
            '鍋',
            'レストラン',
            '麺類',
            'カフェ',
            'パン',
            'お酒',
            'その他'
            ];
          for($num = 0; $num <= 11; $num++) {
            echo '<td><input type="checkbox" id="genre_'.$num.'" name="'.$genre[$num].'"><label for="'.$genre[$num].'">'.$genre[$num].'</label></td>';
          }
        ?>
    </tr>
    <tr>
        <td>定休日(休みを選択してください。)</td>
        <?php
          $day = [
            '月',
            '火',
            '水',
            '木',
            '金',
            '土',
            '日'
            ];
          for($num = 0; $num <= 6; $num++) {
            echo '<td><input type="checkbox" id="day_'.$num.'" name="'.$day[$num].'"><label for="'.$day[$num].'">'.$day[$num].'</label></td>';
          }
        ?>
    </tr>
    <tr>
      <td>備考</td>
      <td><textarea></textarea></td>
    </tr>
    <tr>
      <td>店舗URL</td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td>お持ち帰り可</td>
      <td><input type="checkbox" id="takeout" name="takeout"><label for="takeout"></label></td>
    </tr>
    <tr>
      <td>出前サイトURL</td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td>住所</td>
      <td><input type="text"></td>
    </tr>
    <tr>
      <td>メニュー画像</td>
      <td><input type="file"></td>
      <td><input type="file"></td>
      <td><input type="file"></td>
    </tr>
    <tr>
      <td>メニューの説明</td>
      <td><textarea></textarea></td>
    </tr>
  </table>
  <button>登録</button>
</div>