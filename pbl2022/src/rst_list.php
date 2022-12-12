<div class="rst_list">
  <h2>店舗一覧</h2>

  <div class="searchcondition">
    <div class="search">
      <form action="?do=rst_list" method="post">
        <input type="search" name="searchname" value="<?php //if(isset($_POST['searchname'])) {echo $_POST['searchname'];}else if(isset($_SESSION['searchname'])) {echo $_SESSION['searchname'];}
                                                      ?>">
        <button type="submit">検索</button>
      </form>
    </div>
    <div class="sortpos">
      <table>
        <form action="?do=rst_list" method="post">
          <?php
          $sort_sql = [
            "(BUDGET_MAX + BUDGET_MIN)/2 DESC" => "平均金額が高い順",
            "(BUDGET_MAX + BUDGET_MIN)/2 " => "平均金額が低い順",
            "count DESC" => "評価数が高い順",
            "count" => "評価数が低い順",
            "ave DESC" => "評価が高い順",
            "ave" => "評価が低い順"
          ];
          $value_count = 0;
          foreach ($sort_sql as $value => $name) {
            if ($value_count % 2 == 0) {
              echo "<tr>";
            }
            echo "<td>";
            echo '<input type="radio" name="sort" value="' . $value . '"';
            if (isset($_POST['sort']) && $_POST['sort'] == $value) {
              echo "checked";
            }
            echo ">" . $name . "<td>";
            if ($value_count % 2 == 1) {
              echo "</tr>";
            }
            $value_count++;
          }
          ?>
      </table>
    </div>
    <div class="filterpos">
      <table>
        <tr>
          <td>値段目安</td>
          <td>
            <select name="budgetmin" size="1">
              <option value=null>下限額を入力</option>
              <?php
              for ($i = 0; $i <= 5000; $i += 500) {
                echo "<option value=" . $i . " ";
                if (isset($_POST['budgetmin']) && $_POST['budgetmin'] == $i) {
                  echo " selected";
                }
                echo ">" . $i . "</option>";
              }
              ?>
            </select>
          </td>
          <td align=center>～</td>
          <td>
            <select name="budgetmax" size="1">
              <option value=null>上限額を入力</option>
              <?php
              for ($i = 500; $i <= 5000; $i += 500) {
                echo "<option value=" . $i . " ";
                if (isset($_POST['budgetmax']) && $_POST['budgetmax'] == $i) {
                  echo " selected";
                }
                echo ">" . $i . "</option>";
              }
              echo "<option value=1000000000";
              if (isset($_POST['budgetmax']) && $_POST['budgetmax'] == 1000000000) {
                echo " selected";
              }
              echo ">5000円以上</option>";
              ?>
            </select>
          </td>
        </tr>
      </table>
      <table>
        <tr>
          <td>開店日(空いている日を選択してください。)</td>
          <?php
          $open_sql = [
            "sunday = 1" => "日曜",
            "monday = 1" => "月曜",
            "tuesday = 1" => "火曜",
            "wednesday = 1" => "水曜",
            "thursday = 1" => "木曜",
            "friday = 1" => "金曜",
            "saturday = 1" => "土曜"
          ];
          foreach ($open_sql as $sql_value => $name) {
            echo '<td><label><input type="checkbox" id="isopen" name="open[]" value = "' . $sql_value . '"';
            if (isset($_POST['open'])) {
              foreach ($_POST['open'] as $value) {
                if ($sql_value == $value) {
                  echo 'checked';
                }
              }
            }
            echo ">" . $name . "</label></td>";
          }
          ?>
        </tr>
      </table>
      <table>
        <tr>
          <td>ジャンル</td>
          <?php
          $genre_sql = [
            "japanese_f = 1" => "和食",
            "western_f = 1" => "洋食",
            "asian_f = 1" => "アジア",
            "curry = 1" => "カレー",
            "yakiniku = 1" => "焼肉",
            "nabe = 1" => "鍋",
            "restaurant = 1" => "レストラン",
            "noodle = 1" => "麺類",
            "cafe = 1" => "カフェ",
            "bread = 1" => "パン",
            "liquor = 1" => "お酒",
            "others = 1" => "その他",
          ];
          foreach ($genre_sql as $sql_value => $name) {
            echo '<td><label><input type="checkbox" id="genre_" name="genre[]" value = "' . $sql_value . '"';
            if (isset($_POST['genre'])) {
              foreach ($_POST['genre'] as $value) {
                if ($sql_value == $value) {
                  echo 'checked';
                }
              }
            }
            echo ">" . $name . "</label></td>";
          }
          ?>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td align="right"><input type="submit" value="決定"></td>
        </tr>
      </table>
      </form>
    </div>

  </div>


  <?php

  require_once('db_inc.php');
  define('MAX_ROWS', 9); //MAX_ROWS: 1ページに表示する最大行数

  if (isset($_GET['p']) && $_GET['p'] != "") {
    //ページ番号を切り替えてもsqlが書き変わらないように
    $sql = $_SESSION['sqlsave'];
  } else {
    //ベースのsql文
    $sql = "SELECT *, (SELECT COUNT(*) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as count,
   (SELECT ROUND(AVG(eval_point),1) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as ave 
   FROM t_rstinfo JOIN t_open ON t_rstinfo.rst_id = t_open.rst_id JOIN t_genre ON t_rstinfo.rst_id = t_genre.rst_id JOIN t_user ON t_rstinfo.user_id = t_user.user_id";
    if (!isset($_POST['searchname'])) {
      //検索が行われていない
      //WHEREを付ける
      if ((isset($_POST['budgetmax']) && isset($_POST['budgetmin']))) {
        if (($_POST['budgetmax'] != "null" && $_POST['budgetmin'] != "null") || isset($_POST['open']) || isset($_POST['genre'])) {
          $sql = $sql . " WHERE ";
        }
      }
      //金額
      $budgetcount = 0;
      if (isset($_POST['budgetmax']) && isset($_POST['budgetmin'])) {
        if ($_POST['budgetmax'] != "null" && $_POST['budgetmin'] != "null") {
          $budgetcount = 1;
          $sql = $sql . "(" . $_POST['budgetmax'] . ">= t_rstinfo.budget_max AND t_rstinfo.budget_min >= " . $_POST['budgetmin'] . ")";
        } else if (isset($_POST['budgetmax'])) {
        }
      }
      //開店日
      $daycount = 0;
      if (isset($_POST['open'])) {
        $openday = $_POST['open'];
        foreach ($openday as $value) {
          if ($daycount == 0 && $budgetcount == 0) {
            $sql = $sql . $value;
            $daycount = 1;
          } else {
            $sql = $sql . " AND " . $value;
          }
        }
      }
      //ジャンル
      if (isset($_POST['genre'])) {
        $genre = $_POST['genre'];
        $genrecount = 0;
        foreach ($genre as $value) {
          if ($genrecount == 0 && $budgetcount == 0 && $daycount == 0) {
            $sql = $sql . $value;
            $genrecount = 1;
          } else {
            $sql = $sql . " AND " . $value;
          }
        }
      }
      //ORDER BY
      if (isset($_POST['sort'])) {
        $sql = $sql . " ORDER BY " . $_POST['sort'];
      }
    } else {
      //検索が行われている
      $sql = "SELECT *, (SELECT COUNT(*) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as count,
      (SELECT ROUND(AVG(eval_point),1) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as ave 
      FROM t_rstinfo JOIN t_open ON t_rstinfo.rst_id = t_open.rst_id JOIN t_genre ON t_rstinfo.rst_id = t_genre.rst_id JOIN t_user ON t_rstinfo.user_id = t_user.user_id WHERE t_rstinfo.rst_name LIKE '%" . $_POST['searchname'] . "%' ORDER BY t_rstinfo.rst_id";
    }
  }




  $rs = $conn->query($sql);
  $num_rows = mysqli_num_rows($rs);
  $max_page = ceil($num_rows / MAX_ROWS);
  if (!$rs) die('エラー: ' . $conn->error);

  //表示したいページの番号、行番号を求める
  $page = isset($_GET['p']) ? $_GET['p'] : 1;
  if ($page < 1) $page = 1; //無効なページ番号を回避
  if ($page > $max_page) $page = $max_page;
  $offset = ($page - 1)  * MAX_ROWS;




  echo '<div class = "rst_grid">';
  //架空の店舗ID（1～3）を使って一覧を作っている
  //実際の店舗情報は、DBから検索したものを使ってください
  //DBからデータを検索し、while文で複数の店舗の情報を一つずつ受けとり、画像とどもに表示する
  //$row = $rs->fetch_assoc();
  //指定ページの結果を取り出す

  $_SESSION['sqlsave'] = $sql;
  $sql = sprintf("%s LIMIT %d OFFSET %d", $sql, MAX_ROWS, $offset);
  $rs = $conn->query($sql);
  if ($rs) {
    $row = $rs->fetch_assoc();
    while ($row) {
      echo '<div class = "item">';
      echo '<a href="?do=rst_detail&rst_id=' . $row['rst_id'] . '">';
      echo '<img src="img/' . $row['rst_photo'] . '">';
      echo '</a>';
      if ($row['takeout'] == 1) {
        echo '<br>', 'テイクアウト：可能';
      } else {
        echo '<br>', 'テイクアウト：不可';
      }
      if ($row['delivery'] == 1) {
        echo '　', 'デリバリー：可能';
      } else {
        echo '　', 'デリバリー：不可';
      }
      echo '<br>', '店舗名：' . $row['rst_name'];
      echo '<br>', '評価数：' . $row['count'];
      echo '<br>', '評価平均：' . $row['ave'];

      $japanese_f = $row['japanese_f'];//和食の可=1/否=0
      $western_f = $row['western_f'];//洋食の可=1/否=0
      $asian_f = $row['asian_f'];//アジアの可=1/否=0
      $curry = $row['curry'];//カレーの可=1/否=0
      $yakiniku = $row['yakiniku'];//焼肉の可=1/否=0
      $nabe = $row['nabe'];//鍋の可=1/否=0
      $restaurant = $row['restaurant'];//レストランの可=1/否=0
      $noodle = $row['noodle'];//麺類の可=1/否=0
      $cafe = $row['cafe'];//カフェの可=1/否=0
      $bread = $row['bread'];//パンの可=1/否=0
      $liquor = $row['liquor'];//お酒の可=1/否=0
      $others = $row['others'];//そのほかの可=1/否=0
      $rst_genre = "";
      if ($japanese_f == 1) {
        $rst_genre = $rst_genre . "日本食 ";
      }
      if ($western_f == 1) {
        $rst_genre = $rst_genre . "洋食 ";
      }
      if ($asian_f == 1) {
        $rst_genre = $rst_genre . "アジア ";
      }
      if ($curry == 1) {
        $rst_genre = $rst_genre . "カレー ";
      }
      if ($yakiniku == 1) {
        $rst_genre = $rst_genre . "焼肉 ";
      }
      if ($nabe == 1) {
        $rst_genre = $rst_genre . "鍋 ";
      }
      if ($restaurant == 1) {
        $rst_genre = $rst_genre . "レストラン ";
      }
      if ($noodle == 1) {
        $rst_genre = $rst_genre . "麺類 ";
      }
      if ($cafe == 1) {
        $rst_genre = $rst_genre . "カフェ ";
      }
      if ($bread == 1) {
        $rst_genre = $rst_genre . "パン ";
      }
      if ($liquor == 1) {
        $rst_genre = $rst_genre . "お酒 ";
      }
      if ($others == 1) {
        $rst_genre = $rst_genre . "その他 ";
      }
      echo '<br>', 'ジャンル：' . $rst_genre;

      echo '<br>', '平均予算：' . ($row['budget_max'] + $row['budget_min']) / 2 . '円';

      //開店日文字列
      $rst_close = "";
      if ($row['sunday'] == 1) {
        $rst_close = $rst_close . "日 ";
      }
      if ($row['monday'] == 1) {
        $rst_close = $rst_close . "月 ";
      }
      if ($row['tuesday'] == 1) {
        $rst_close = $rst_close . "火 ";
      }
      if ($row['wednesday'] == 1) {
        $rst_close = $rst_close . "水 ";
      }
      if ($row['thursday'] == 1) {
        $rst_close = $rst_close . "木 ";
      }
      if ($row['friday'] == 1) {
        $rst_close = $rst_close . "金 ";
      }
      if ($row['saturday'] == 1) {
        $rst_close = $rst_close . "土 ";
      }
      echo '<br>', '開店日：' . $rst_close;
      echo '<br>', '最終投稿者：' . $row['user_kana'];
      echo '</div>';
      $row = $rs->fetch_assoc(); //次の行へ
    }
  } else {
    echo '<h2>ご指定の検索条件に該当する店舗がございませんでした。</h2>';
  }

  echo '</div>';
  echo '<div class = "paging">';
  for ($j = 1; $j <= $max_page; $j++) {
    if ($j == $page) echo $j, ' ';
    else printf('<a href="?do=rst_list&p=%d">%d</a> ', $j, $j);
  }
  echo '</div>';
  ?>
</div>


<script>
  function sql_code(val) {
    //ここでvalをが入るSQLを記入する。
    //console.log(val);
    var value = val;
    document.cookie = 'value =; max-age=0';
    document.cookie = 'value =' + value;
    <?php
    if (isset($_COOKIE['value'])) {
      $val = $_COOKIE['value'];
      //echo "console.log('" . $val . "');";
    }
    ?>

  }
</script>