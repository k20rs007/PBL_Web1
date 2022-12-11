<!--
  if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // 画像を取得

} else {
    // 画像を保存
    if (!empty($_FILES['test']['name'])) {
        $name = $_FILES['test']['name'];

        move_uploaded_file($_FILES['test']['tmp_name'], './img/' . $name);
        echo '<img src="./img/' . $name . '">';     
    }
    if(!empty($_POST['testtest'])) {
      echo $_POST['testtest'];     
    }
}
-->


<?php
require_once('db_inc.php');

$user_id = $_SESSION['user_id'];
// 変数の初期化。新規登録か編集かにより異なる。
$act = 'insert'; // 新規登録の場合
if (isset($_GET['rst_id'])) { //既存アカウントを編集する場合
  $rst_id = $_GET['rst_id'];
  // 既存アカウントの情報を検索するSQL文
  $sql = "SELECT * FROM `t_rstinfo` WHERE rst_id='{$rst_id}'";
  // データベースへ問合せのSQL($sql)を実行する・・・
  $rs = $conn->query($sql);;
  if (!$rs) die('エラー: ' . $conn->error);

  //問合せ結果を取得し、それぞれの変数に代入しておく
  $row = $rs->fetch_assoc();;
  if ($row) { // 既存アカウントを編集するために、変数に代入
    $act = 'update';
    $rst_name = $row['rst_name'];
  }
}
/*
    */ else {
  $sql = "SELECT COUNT(*) AS num FROM `t_rstinfo`";
  $rs = $conn->query($sql);;
  $row = $rs->fetch_assoc();;
  if ($row) { //問合せ結果がある場合、ログイン成功
    //$num = count($row); //受け取ったデータ（配列）を表示して、内容を確認するー＞デバッグ時
    //$rst_id = $num+1;
    $num = $row['num'];
    $rst_id = $num + 1;
  }
}
/*
  */
?>
<div class="rst_add">
  <!--
<form action="?do=rst_add" method="post" enctype="multipart/form-data">
<input type="file" name="test"></input>
<input type='text' name="testtest"></input>
<button>送信</button>
</form>
-->
  <?php
  echo '<form action="?do=rst_save&rst_id=' . $rst_id . '"  method="post" enctype="multipart/form-data">';
  ?>
  <input type="hidden" name="act" value="<?php echo $act; ?>">
  <!--<div class="rst_add">-->
  <h2>店舗登録</h2>
  <?php //echo $rst_id 
  ?>
  <table>
    <tr>
      <td>店舗名</td>
      <td><input type="text" name="rst_name" required></td>
    </tr>
    <tr>
      <td>店舗画像</td>
      <td><img id="rst_img" accept=".image/*" src="https://illustimage.com/photo/dl/1706.png?20151101">
        <input type="file" id="rst_form" name="rst_photo" required accept=".jpg, .jpeg, .png, .gif">
      </td>
    </tr>
    <tr>
      <td>店舗説明</td>
      <td><textarea name="rst_info" required cols="70" rows="10"></textarea></td>
    </tr>
    <tr>
      <td>時間(平日)</td>
      <td><select name="start_time_weekday_hour" required>
          <?php
          for ($num = 0; $num <= 24; $num++) {
            if ($num < 10) {
              $a = 0;
            } else {
              $a = "";
            }
            echo '<option>' . $a . $num . '</option>';
          }
          ?>
        </select>
        ：
        <select name="start_time_weekday_min" required>
          echo '<option>00</option>';
          <?php
          for ($num = 1; $num <= 59; $num++) {
            if ($num < 10) {
              $a = 0;
            } else {
              $a = "";
            }
            echo '<option>' . $a . $num . '</option>';
          }
          ?>
        </select>
        　～　
        <select name="end_time_weekday_hour" required>
          <?php
          for ($num = 0; $num <= 24; $num++) {
            if ($num < 10) {
              $a = 0;
            } else {
              $a = "";
            }
            echo '<option>' . $a . $num . '</option>';
          }
          ?>
        </select>
        ：
        <select name="end_time_weekday_min" required>
          echo '<option>00</option>';
          <?php
          for ($num = 1; $num <= 59; $num++) {
            if ($num < 10) {
              $a = 0;
            } else {
              $a = "";
            }
            echo '<option>' . $a . $num . '</option>';
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>時間(休日)
      <td><select name="start_time_holiday_hour" required>
          <?php
          for ($num = 0; $num <= 24; $num++) {
            if ($num < 10) {
              $a = 0;
            } else {
              $a = "";
            }
            echo '<option>' . $a . $num . '</option>';
          }
          ?>
        </select>
        ：
        <select name="start_time_holiday_min" required>
          echo '<option>00</option>';
          <?php
          for ($num = 1; $num <= 59; $num++) {
            if ($num < 10) {
              $a = 0;
            } else {
              $a = "";
            }
            echo '<option>' . $a . $num . '</option>';
          }
          ?>
        </select>
        　～　
        <select name="end_time_holiday_hour" required>
          <?php
          for ($num = 0; $num <= 24; $num++) {
            if ($num < 10) {
              $a = 0;
            } else {
              $a = "";
            }
            echo '<option>' . $a . $num . '</option>';
          }
          ?>
        </select>
        ：
        <select name="end_time_holiday_min" required>
          echo '<option>00</option>';
          <?php
          for ($num = 1; $num <= 59; $num++) {
            if ($num < 10) {
              $a = 0;
            } else {
              $a = "";
            }
            echo '<option>' . $a . $num . '</option>';
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>電話番号</td>
      <td><input type="text" name="tel_num_1" required size = 6px>
      —
      <input type="text" name="tel_num_2" required size = 6px>
      —
      <input type="text" name="tel_num_3" required size = 6px>
    </tr>
    <tr>
      <td>値段目安</td>
      <td><input type="text" name="budget_min" required size = 6px>
      ～
      <input type="text" name="budget_max" required size = 6px></td>
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
      $tb_genre = [
        'japanese_f',
        'western_f',
        'asian_f',
        'curry',
        'yakiniku',
        'nabe',
        'restaurant',
        'noodle',
        'cafe',
        'bread',
        'liquor',
        'others'
      ];
      echo '<td>';
      for ($num = 0; $num <= 11; $num++) {
        echo '<input type="checkbox" id="genre_' . $num . '" name="' . $tb_genre[$num] . '"><label for="' . $genre[$num] . '">' . $genre[$num] . "　".'</label>';
      }
      echo '</td>';
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
      $tb_day = [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday'
      ];
      echo '<td>';
      for ($num = 0; $num <= 6; $num++) {
        echo '<input type="checkbox" id="day_' . $num . '" name="' . $tb_day[$num] . '"><label for="' . $day[$num] . '">' . $day[$num] ."　". '</label>';
      }
      echo '</td>';
      ?>
    </tr>
    <tr>
      <td>備考</td>
      <td><textarea name="holiday_detail" cols="70" rows="10"></textarea></td>
    </tr>
    <tr>
      <td>店舗URL</td>
      <td><input type="text" name="rst_url" size = 30px></td>
    </tr>
    <tr>
      <td>お持ち帰り可</td>
      <td><input type="checkbox" id="takeout" name="takeout"><label for="takeout"></label></td>
    </tr>
    <tr>
      <td>出前可</td>
      <td><input type="checkbox" id="delivery" name="delivery"><label for="delivery"></label></td>
    </tr>
    <tr>
      <td>出前サイトURL</td>
      <td><input type="text" name="delivery_url" size = 30px></td>
    </tr>
    <tr>
      <td>住所</td>
      <td><input type="text" name="rst_address" size = 90px></td>
    </tr>
    <tr>
      <td>メニュー画像</td>
      <td><img id="photo1_img" accept=".image/*" src="https://illustimage.com/photo/dl/1706.png?20151101">
        <input type="file" id="photo1_form" name="photo1" required accept=".jpg, .jpeg, .png, .gif">
      </td>
    </tr>
    <tr>
      <td></td>
      <td><img id="photo2_img" accept=".image/*" src="https://illustimage.com/photo/dl/1706.png?20151101">
        <input type="file" id="photo2_form" name="photo2" required accept=".jpg, .jpeg, .png, .gif">
      </td>
    </tr>
    <tr>
      <td></td>
      <td><img id="photo3_img" accept=".image/*" src="https://illustimage.com/photo/dl/1706.png?20151101">
        <input type="file" id="photo3_form" name="photo3" required accept=".jpg, .jpeg, .png, .gif">
      </td>
    </tr>
    <!--<td><input type="file" name="photo1" accept=".jpg, .jpeg, .png, .gif></td>
      <td><input type="file" name="photo2" accept=".jpg, .jpeg, .png, .gif></td>
      <td><input type="file" name="photo3" accept=".jpg, .jpeg, .png, .gif></td>-->

    <tr>
      <td>メニューの説明</td>
      <td><textarea name="menu_detail" cols="70" rows="10"></textarea></td>
    </tr>
  </table>
  <button>登録</button>
  </form>

  <?php
  //$rst_id = filter_input(INPUT_POST, 'rst_id');
  $rst_name = filter_input(INPUT_POST, 'rst_name');

  $start_time_weekday_hour = filter_input(INPUT_POST, 'start_time_weekday_hour');
  $start_time_weekday_min = filter_input(INPUT_POST, 'start_time_weekday_min');
  $end_time_weekday_hour = filter_input(INPUT_POST, 'end_time_weekday_hour');
  $end_time_weekday_min = filter_input(INPUT_POST, 'end_time_weekday_min');
  $start_time_holiday_hour = filter_input(INPUT_POST, 'start_time_holiday_hour');
  $start_time_holiday_min = filter_input(INPUT_POST, 'start_time_holiday_min');
  $end_time_holiday_hour = filter_input(INPUT_POST, 'end_time_holiday_hour');
  $end_time_holiday_min = filter_input(INPUT_POST, 'end_time_holiday_min');
  $tel_num_1 = filter_input(INPUT_POST, 'tel_num_1');
  $tel_num_2 = filter_input(INPUT_POST, 'tel_num_2');
  $tel_num_3 = filter_input(INPUT_POST, 'tel_num_3');
  $budget_min = filter_input(INPUT_POST, 'budget_min');
  $budget_max = filter_input(INPUT_POST, 'budget_max');

  $japanese_f = filter_input(INPUT_POST, 'japanese_f');
  $western_f = filter_input(INPUT_POST, 'western_f');
  $asian_f = filter_input(INPUT_POST, 'asian_f');
  $curry = filter_input(INPUT_POST, 'curry');
  $yakiniku = filter_input(INPUT_POST, 'yakiniku');
  $nabe = filter_input(INPUT_POST, 'nabe');
  $restaurant = filter_input(INPUT_POST, 'restaurant');
  $noodle = filter_input(INPUT_POST, 'noodle');
  $cafe = filter_input(INPUT_POST, 'cafe');
  $bread = filter_input(INPUT_POST, 'bread');
  $liquor = filter_input(INPUT_POST, 'liquor');
  $others = filter_input(INPUT_POST, 'others');

  $monday = filter_input(INPUT_POST, 'monday');
  $tuesday = filter_input(INPUT_POST, 'tuesday');
  $wednesday = filter_input(INPUT_POST, 'wednesday');
  $thursday = filter_input(INPUT_POST, 'thursday');
  $friday = filter_input(INPUT_POST, 'friday');
  $saturday = filter_input(INPUT_POST, 'saturday');
  $sunday = filter_input(INPUT_POST, 'sunday');

  $holiday_detail = filter_input(INPUT_POST, 'holiday_detail');
  $rst_url = filter_input(INPUT_POST, 'rst_url');
  $takeout = filter_input(INPUT_POST, 'takeout');
  $delivery = filter_input(INPUT_POST, 'delivery');
  $delivery_url = filter_input(INPUT_POST, 'delivery_url');
  $rst_address = filter_input(INPUT_POST, 'rst_address');
  $menu_detail = filter_input(INPUT_POST, 'menu_detail');


  $rst_photo = filter_input(INPUT_POST, 'rst_photo');
  $photo1 = filter_input(INPUT_POST, 'photo1');
  $photo2 = filter_input(INPUT_POST, 'photo2');
  $photo3 = filter_input(INPUT_POST, 'photo3');
  //$name = $_FILES['rst_photo']['name'];
  //echo $name;
  ?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
</script>
<script>
  // 画像切り替え時にプレビュー表示
  $('#rst_form').on('change', function(e) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $("#rst_img").attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
  });
  $('#photo1_form').on('change', function(e) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $("#photo1_img").attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
  });
  $('#photo2_form').on('change', function(e) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $("#photo2_img").attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
  });
  $('#photo3_form').on('change', function(e) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $("#photo3_img").attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
  });
</script>