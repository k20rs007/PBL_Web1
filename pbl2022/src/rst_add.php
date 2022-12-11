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
    $start_time_weekday = $row['start_time_weekday'];
    $end_time_weekday = $row['end_time_weekday'];
    $start_time_holiday = $row['start_time_holiday'];
    $end_time_holiday = $row['end_time_holiday'];
    $tel_num = $row['tel_num'];
    $budget_min = $row['budget_min'];
    $budget_max = $row['budget_max'];
    $rst_info = $row['rst_info'];
    $holiday_detail = $row['holiday_detail'];
    $rst_url = $row['rst_url'];
    $takeout = $row['takeout'];
    $delivery = $row['delivery'];
    $delivery_url = $row['delivery_url'];
    $rst_address = $row['rst_address'];
    $rst_photo = $row['rst_photo'];
    $photo1 = $row['photo1'];
    $photo2 = $row['photo2'];
    $photo3 = $row['photo3'];
    $menu_detail = $row['menu_detail'];
  }

  $sql = "SELECT * FROM `t_genre` WHERE rst_id='{$rst_id}'";
  $rs = $conn->query($sql);;
  if (!$rs) die('エラー: ' . $conn->error);
  $row = $rs->fetch_assoc();;
  if ($row) { // 既存アカウントを編集するために、変数に代入
    $japanese_f = $row['japanese_f'];
    $western_f = $row['western_f'];
    $asian_f = $row['asian_f'];
    $curry = $row['curry'];
    $yakiniku = $row['yakiniku'];
    $nabe = $row['nabe'];
    $restaurant = $row['restaurant'];
    $noodle = $row['noodle'];
    $cafe = $row['cafe'];
    $bread = $row['bread'];
    $liquor = $row['liquor'];
    $others = $row['others'];
  }

  $sql = "SELECT * FROM `t_open` WHERE rst_id='{$rst_id}'";
  $rs = $conn->query($sql);;
  if (!$rs) die('エラー: ' . $conn->error);
  $row = $rs->fetch_assoc();;
  if ($row) { // 既存アカウントを編集するために、変数に代入
    $monday = $row['monday'];
    $tuesday = $row['tuesday'];
    $wednesday = $row['wednesday'];
    $thursday = $row['thursday'];
    $friday = $row['friday'];
    $saturday = $row['saturday'];
    $sunday = $row['sunday'];
  }
}
/*
*/ 
  else {
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
    $act
?>

  <input type="hidden" name="act" value="<?php echo $act; ?>">
  <!--<div class="rst_add">-->
  <?php 
    if($act=='update') {
      echo '<h2>店舗編集</h2>';
      $value_rst_name='value="'.$rst_name.'"';
      $value_start_time_weekday='value="'.$start_time_weekday.'"';
      $value_end_time_weekday='value="'.$end_time_weekday.'"';
      $value_start_time_holiday='value="'.$end_time_holiday.'"';
      $value_end_time_holiday='value="'.$end_time_holiday.'"';
      $telnums = explode('-',$tel_num);
      $value_tel_num1='value="'.$telnums[0].'"';
      $value_tel_num2='value="'.$telnums[1].'"';
      $value_tel_num3='value="'.$telnums[2].'"';
      $value_budget_min='value="'.$budget_min.'"';
      $value_budget_max='value="'.$budget_max.'"';
      $value_rst_info=$rst_info;
      $value_holiday_detail=$holiday_detail;
      $value_rst_url='value="'.$rst_url.'"';
      $value_takeout=$takeout;
      $value_delivery=$delivery;
      $value_delivery_url='value="'.$delivery_url.'"';
      $value_rst_address='value="'.$rst_address.'"';
      $value_rst_photo = 'img/'.$rst_photo.'"';
      $value_photo1='img/'.$photo1.'"';
      $value_photo2='img/'.$photo2.'"';
      $value_photo3='img/'.$photo3.'"';
      $value_menu_detail=$menu_detail;

      if($japanese_f=='1') {
        $value_japanese_f='checked';
      } else {
        $value_japanese_f='';
      }
      if($western_f=='1') {
        $value_western_f='checked';
      } else {
        $value_western_f='';
      }
      if($asian_f=='1') {
        $value_asian_f='checked';
      } else {
        $value_asian_f='';
      }
      if($curry=='1') {
        $value_curry='checked';
      } else {
        $value_curry='';
      }
      if($yakiniku=='1') {
        $value_yakiniku='checked';
      } else {
        $value_yakiniku='';
      }
      if($nabe=='1') {
        $value_nabe='checked';
      } else {
        $value_nabe='';
      }
      if($restaurant=='1') {
        $value_restaurant='checked';
      } else {
        $value_restaurant='';
      }
      if($noodle=='1') {
        $value_noodle='checked';
      } else {
        $value_noodle='';
      }
      if($cafe=='1') {
        $value_cafe='checked';
      } else {
        $value_cafe='';
      }
      if($bread=='1') {
        $value_bread='checked';
      } else {
        $value_bread='';
      }
      if($bread=='1') {
        $value_bread='checked';
      } else {
        $value_bread='';
      }
      if($liquor=='1') {
        $value_liquor='checked';
      } else {
        $value_liquor='';
      }
      if($others=='1') {
        $value_others='checked';
      } else {
        $value_others='';
      }

      $tb_genre_checked = [
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        ''
      ];
      
      $tb_genre_checked[0] = $value_japanese_f;
      $tb_genre_checked[1] = $value_western_f;
      $tb_genre_checked[2] = $value_asian_f;
      $tb_genre_checked[3] = $value_curry;
      $tb_genre_checked[4] = $value_yakiniku;
      $tb_genre_checked[5] = $value_nabe;
      $tb_genre_checked[6] = $value_restaurant;
      $tb_genre_checked[7] = $value_noodle;
      $tb_genre_checked[8] = $value_cafe;
      $tb_genre_checked[9] = $value_bread;
      $tb_genre_checked[10] = $value_liquor;
      $tb_genre_checked[11] = $value_others;

      if($monday=='0') {
        $value_monday='checked';
      } else {
        $value_monday='';
      }
      if($tuesday=='0') {
        $value_tuesday='checked';
      } else {
        $value_tuesday='';
      }
      if($wednesday=='0') {
        $value_wednesday='checked';
      } else {
        $value_wednesday='';
      }
      if($thursday=='0') {
        $value_thursday='checked';
      } else {
        $value_thursday='';
      }
      if($friday=='0') {
        $value_friday='checked';
      } else {
        $value_friday='';
      }
      if($saturday=='0') {
        $value_saturday='checked';
      } else {
        $value_saturday='';
      }
      if($sunday=='0') {
        $value_sunday='checked';
      } else {
        $value_sunday='';
      }

      $tb_open_checked = [
        '',
        '',
        '',
        '',
        '',
        '',
        ''
      ];

      $tb_open_checked[0] = $value_monday;
      $tb_open_checked[1] = $value_tuesday;
      $tb_open_checked[2] = $value_wednesday;
      $tb_open_checked[3] = $value_thursday;
      $tb_open_checked[4] = $value_friday;
      $tb_open_checked[5] = $value_saturday;
      $tb_open_checked[6] = $value_sunday;

    } else {
      echo '<h2>店舗登録</h2>';
      $value_rst_name='';
      $value_start_time_weekday_hour='';
      $value_start_time_weekday_min='';
      $value_end_time_holiday_hour='';
      $value_end_time_holiday_min='';
      $value_start_time_holiday_hour='';
      $value_start_time_holiday_min='';
      $value_end_time_holiday_hour='';
      $value_end_time_holiday_min='';
      $value_tel_num1='';
      $value_tel_num2='';
      $value_tel_num3='';
      $value_budget_min='';
      $value_budget_max='';
      $value_rst_info='';
      $value_holiday_detail='';
      $value_rst_url='';
      $value_takeout='';
      $value_delivery='';
      $value_delivery_url='';
      $value_rst_address='';
      $value_rst_photo='';
      $value_photo1='';
      $value_photo2='';
      $value_photo3='';
      $value_menu_detail='';

      $tb_genre_checked = [
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        ''
      ];

      $tb_open_checked = [
        '',
        '',
        '',
        '',
        '',
        '',
        ''
      ];
    }
  ?>
  
  <table>
    <tr>
      <td>店舗名</td>
      <td>
        <?php echo '<input type="text" name="rst_name" '.$value_rst_name.' required>';?>
      </td>
    </tr>
    <tr>
      <td>店舗画像</td>
      <td>
        <?php
          if($value_rst_photo=='') {
            $a = 'https://illustimage.com/photo/dl/1706.png?20151101';
          } else {
            $a = $value_rst_photo;
          }
          echo '<img id="rst_img" accept=".image/*" src="'.$a.'">';
        
          if($act=='update') {
            echo '<input type="file" id="rst_form" name="rst_photo" accept=".jpg, .jpeg, .png, .gif">';
          } else {
            echo '<input type="file" id="rst_form" name="rst_photo" required accept=".jpg, .jpeg, .png, .gif">';
          }
        ?>
      </td>
    </tr>
    <tr>
      <td>店舗説明</td>
      <td>
        <?php echo '<textarea name="rst_info" required cols="70" rows="10">'.$value_rst_info.'</textarea>';?>
      </td>
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
      <td>
        <?php echo '<input type="text" name="tel_num_1" '.$value_tel_num1.' required size = 6px>';?>
      —
        <?php echo '<input type="text" name="tel_num_2" '.$value_tel_num2.' required size = 6px>';?>
      —
        <?php echo '<input type="text" name="tel_num_3" '.$value_tel_num3.' required size = 6px>';?>
    </tr>
    <tr>
      <td>値段目安</td>
      <td>
        <?php echo '<input type="text" name="budget_min" '.$value_budget_min.' required size = 6px>';?>
      ～
        <?php echo '<input type="text" name="budget_max" '.$value_budget_max.' required size = 6px>';?>
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
        echo '<input type="checkbox" class="check" id="genre_' . $num . '" name="' . $tb_genre[$num] . '"'.$tb_genre_checked[$num].'><label for="' . $genre[$num] . '">' . $genre[$num] . "　".'</label>';
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
        echo '<input type="checkbox" id="day_' . $num . '" name="' . $tb_day[$num] . '"'.$tb_open_checked[$num].'><label for="' . $day[$num] . '">' . $day[$num] ."　". '</label>';
      }
      echo '</td>';
      ?>
    </tr>
    <tr>
      <td>備考</td>
      <td>
        <?php echo '<textarea name="holiday_detail" cols="70" rows="10">'.$value_holiday_detail.'</textarea>';?>
      </td>
    </tr>
    <tr>
      <td>店舗URL</td>
      <td>
        <?php echo '<input type="text" name="rst_url" '.$value_rst_url.' size = 30px>';?>
      </td>
    </tr>
    <tr>
      <td>お持ち帰り可</td>
      <td>
        <?php
          if($value_takeout=='1') {
            $a = 'checked';
          } else {
            $a = '';
          }
          echo '<input type="checkbox" id="takeout" name="takeout"'.$a.'><label for="takeout"></label>';
        ?>
      </td>
    </tr>
    <tr>
      <td>出前可</td>
      <td>
        <?php
            if($value_delivery=='1') {
              $a = 'checked';
            } else {
              $a = '';
            }
            echo '<input type="checkbox" id="delivery" name="delivery"'.$a.'><label for="delivery"></label>';
        ?>
      </td>
    </tr>
    <tr>
      <td>出前サイトURL</td>
      <td>
        <?php echo '<input type="text" name="delivery_url" '.$value_delivery_url.' size = 30px>';?>
      </td>
    </tr>
    <tr>
      <td>住所</td>
      <td>
        <?php echo '<input type="text" name="rst_address" '.$value_rst_address.' size = 90px>';?>
      </td>
    </tr>
    <tr>
      <td>メニュー画像</td>
      <td>
        <?php
          if($value_photo1==''||$value_photo1=="noimage") {
            $a = 'https://illustimage.com/photo/dl/1706.png?20151101';
          } else {
            $a = $value_photo1;
          }
          echo '<img id="photo1_img" accept=".image/*" src="'.$a.'">';
        ?>
        <input type="file" id="photo1_form" name="photo1" accept=".jpg, .jpeg, .png, .gif">
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <?php
          if($value_photo2==''||$value_photo2=="noimage") {
            $a = 'https://illustimage.com/photo/dl/1706.png?20151101';
          } else {
            $a = $value_photo2;
          }
          echo '<img id="photo2_img" accept=".image/*" src="'.$a.'">';
        ?>
        <input type="file" id="photo2_form" name="photo2" accept=".jpg, .jpeg, .png, .gif">
      </td>
    </tr>
    <tr>
      <td></td>
      <td>
        <?php
          if($value_photo3==''||$value_photo3=="noimage") {
            $a = 'https://illustimage.com/photo/dl/1706.png?20151101';
          } else {
            $a = $value_photo3;
          }
          echo '<img id="photo3_img" accept=".image/*" src="'.$a.'">';
        ?>
        <input type="file" id="photo3_form" name="photo3" accept=".jpg, .jpeg, .png, .gif">
      </td>
    </tr>
    <!--<td><input type="file" name="photo1" accept=".jpg, .jpeg, .png, .gif></td>
      <td><input type="file" name="photo2" accept=".jpg, .jpeg, .png, .gif></td>
      <td><input type="file" name="photo3" accept=".jpg, .jpeg, .png, .gif></td>-->

    <tr>
      <td>メニューの説明</td>
      <td>
        <?php echo '<textarea name="menu_detail" cols="70" rows="10">'.$value_menu_detail.'</textarea>';?>
      </td>
    </tr>
  </table>
  <button onclick="return isCheck()">登録</button>
  </form>

  <?php
    //$rst_id = filter_input(INPUT_POST, 'rst_id');
    //if($act=='update') {

    //} else {
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
    //}
    
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

  function isCheck() {
    let arr_checkBoxes = document.getElementsByClassName("check");
    let count = 0;
    for (let i = 0; i < arr_checkBoxes.length; i++) {
        if (arr_checkBoxes[i].checked) {
            count++;
        }
    }
    if (count > 0) {
        return true;
    } else {
        window.alert("ジャンルを1つ以上選択してください。");
        return false;
    };
 
}
</script>