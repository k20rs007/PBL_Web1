<div class="rst_list">
  <h2>店舗一覧</h2>

  <div class="searchcondition">
    <div class="search">
      <form action="?do=rst_list" method="post">
        <input type="search" name="searchname">
        <button type="submit">検索</button>
      </form>
    </div>
    <div class="sortpos">
      <table>
        <form action="?do=rst_list" method="post">
          <tr>
            <td>
              <input type="radio" name="sort" value="(BUDGET_MAX + BUDGET_MIN)/2 DESC">平均金額が高い順
            </td>
            <td>
              <input type="radio" name="sort" value="(BUDGET_MAX + BUDGET_MIN)/2">平均金額が低い順
            </td>
          </tr>
          <tr>
            <td>
              <input type="radio" name="sort" value="count DESC">評価数が多い順
            </td>
            <td>
              <input type="radio" name="sort" value="count">評価数が少ない順
            </td>
          </tr>
          <tr>
            <td>
              <input type="radio" name="sort" value="ave DESC">評価平均が高い順
            </td>
            <td>
              <input type="radio" name="sort" value="ave">評価平均が低い順
            </td>
          </tr>
      </table>
    </div>
    <div class="filterpos">
      <table>
        <tr>
          <td>値段目安</td>
          <td>
            <select name="budgetmin" size="1">
              <option value=null>下限額を入力</option>
              <option value=0>0</option>
              <option value=500>500</option>
              <option value=1000>1000</option>
              <option value=1500>1500</option>
              <option value=2000>2000</option>
              <option value=2500>2500</option>
              <option value=3000>3000</option>
              <option value=3500>3500</option>
              <option value=4000>4000</option>
              <option value=4500>4500</option>
              <option value=5000>5000</option>
            </select>
          </td>
          <td align=center>～</td>
          <td>
            <select name="budgetmax" size="1">
              <option value=null>上限額を入力</option>
              <option value=500>500</option>
              <option value=1000>1000</option>
              <option value=1500>1500</option>
              <option value=2000>2000</option>
              <option value=2500>2500</option>
              <option value=3000>3000</option>
              <option value=3500>3500</option>
              <option value=4000>4000</option>
              <option value=4500>4500</option>
              <option value=5000>5000</option>
            </select>
          </td>
        </tr>
      </table>
      <table>
        <tr>
          <td>開店日(空いている日を選択してください。)</td>
          <?php
          echo '<td><label><input type="checkbox" id="isopen" name="open[]" value = "sunday = 1">日曜</label></td>';
          echo '<td><label><input type="checkbox" id="isopen" name="open[]" value = "monday = 1">月曜</label></td>';
          echo '<td><label><input type="checkbox" id="isopen" name="open[]" value = "tuesday = 1">火曜</label></td>';
          echo '<td><label><input type="checkbox" id="isopen" name="open[]" value = "wednesday = 1">水曜</label></td>';
          echo '<td><label><input type="checkbox" id="isopen" name="open[]" value = "thursday = 1">木曜</label></td>';
          echo '<td><label><input type="checkbox" id="isopen" name="open[]" value = "friday = 1">金曜</label></td>';
          echo '<td><label><input type="checkbox" id="isopen" name="open[]" value = "saturday = 1">土曜</label></td>';
          ?>
        </tr>
      </table>
      <table>
        <tr>
          <td>ジャンル</td>
          <?php
          echo '<td><label><input type="checkbox" id="genre_" name="genre[]" value = "japanese_f = 1">和食</label></td>';
          echo '<td><label><input type="checkbox" id="genre_" name="genre[]" value = "western_f = 1">洋食</label></td>';
          echo '<td><label><input type="checkbox" id="genre_" name="genre[]" value = "asian_f = 1">アジア</label></td>';
          echo '<td><label><input type="checkbox" id="genre_" name="genre[]" value = "curry = 1">カレー</label></td>';
          echo '<td><label><input type="checkbox" id="genre_" name="genre[]" value = "yakiniku = 1">焼肉</label></td>';
          echo '<td><label><input type="checkbox" id="genre_" name="genre[]" value = "nabe = 1">鍋</label></td>';
          echo '<td><label><input type="checkbox" id="genre_" name="genre[]" value = "restaurant = 1">レストラン</label></td>';
          echo '<td><label><input type="checkbox" id="genre_" name="genre[]" value = "noodle = 1">麺類</label></td>';
          echo '<td><label><input type="checkbox" id="genre_" name="genre[]" value = "cafe = 1">カフェ</label></td>';
          echo '<td><label><input type="checkbox" id="genre_" name="genre[]" value = "bread = 1">パン</label></td>';
          echo '<td><label><input type="checkbox" id="genre_" name="genre[]" value = "liquor = 1">お酒</label></td>';
          echo '<td><label><input type="checkbox" id="genre_" name="genre[]" value = "others = 1">その他</label></td>';
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
   FROM t_rstinfo JOIN t_open ON t_rstinfo.rst_id = t_open.rst_id JOIN t_genre ON t_rstinfo.rst_id = t_genre.rst_id";
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
    (SELECT ROUND(AVG(eval_point),1) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as ave FROM t_rstinfo WHERE t_rstinfo.rst_name LIKE '%" . $_POST['searchname'] . "%' ORDER BY rst_id";
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
      echo '<img src="img/rst1_photo1.jpg">';
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
      echo '<br>', 'ジャンル：' . $row['genre'];
      echo '<br>', '平均予算：' . ($row['budget_max'] + $row['budget_min']) / 2 . '円';
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
      echo "console.log('" . $val . "');";
    }
    ?>

  }
</script>