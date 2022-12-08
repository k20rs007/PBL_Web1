<div class="rst_list">
  <h2>店舗一覧</h2>

  <div class="searchcondition">
    <div class="search">
      <form action="?do=rst_list" method="post">
        <input type="search" name = "searchname">
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
              <input type="radio" name="sort" value="ave DESC">評価平均が低い順
            </td>
          </tr>
          <tr>
            <td><input type="submit" value="並び替え"></td>
          </tr>
      </table>
      </form>
    </div>
    <div class="filterpos">
      <table>
        <tr>
          <td>値段目安</td>
          <td>
            <select name="example2" size="1">
              <option value="">下限額を入力</option>
              <option>0</option>
              <option>500</option>
              <option>1000</option>
              <option>1500</option>
              <option>2000</option>
              <option>2500</option>
              <option>3000</option>
              <option>3500</option>
              <option>4000</option>
              <option>4500</option>
              <option>5000</option>
            </select>
          </td>
          <td align=center>～</td>
          <td>
            <select name="example2" size="1">
              <option value="">上限額を入力</option>
              <option>500</option>
              <option>1000</option>
              <option>1500</option>
              <option>2000</option>
              <option>2500</option>
              <option>3000</option>
              <option>3500</option>
              <option>4000</option>
              <option>4500</option>
              <option>5000</option>
              <option>5000以上</option>
            </select>
          </td>
        </tr>
      </table>
      <table>
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
          for ($num = 0; $num <= 6; $num++) {
            echo '<td><input type="checkbox" id="day_' . $num . '" name="' . $day[$num] . '"><label for="' . $day[$num] . '">' . $day[$num] . '</label></td>';
          }
          ?>
        </tr>
      </table>
      <table>
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
          for ($num = 0; $num <= 11; $num++) {
            echo '<td><input type="checkbox" id="genre_' . $num . '" name="' . $genre[$num] . '"><label for="' . $genre[$num] . '">' . $genre[$num] . '</label></td>';
          }
          ?>
        </tr>
        <tr>
            <td><input type="submit" value="絞り込み"></td>
          </tr>
      </table>
    </div>
  </div>


  <?php
  require_once('db_inc.php');
  define('MAX_ROWS', 9); //MAX_ROWS: 1ページに表示する最大行数
  if(!isset($_POST['searchname'])){
    if (!isset($_POST['sort'])) {
      $sql = "SELECT *, (SELECT COUNT(*) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as count,
     (SELECT ROUND(AVG(eval_point),1) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as ave FROM t_rstinfo ORDER BY rst_id";
    } else {
      $sql = "SELECT *, (SELECT COUNT(*) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as count,
     (SELECT ROUND(AVG(eval_point),1) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as ave FROM t_rstinfo ORDER BY " . $_POST['sort'];
    }
  } else {
    $sql = "SELECT *, (SELECT COUNT(*) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as count,
    (SELECT ROUND(AVG(eval_point),1) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as ave FROM t_rstinfo WHERE t_rstinfo.rst_name LIKE '%". $_POST['searchname'] ."%' ORDER BY rst_id";
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

  $sql = sprintf("%s LIMIT %d OFFSET %d", $sql, MAX_ROWS, $offset);
  $rs = $conn->query($sql);
  $row = $rs->fetch_assoc();
  while ($row) {
    echo '<div class = "item">';
    echo '<a href="?do=rst_detail&rst_id=' . $row['rst_id'] . '">';
    echo '<img src="img/rst1_photo1.jpg">';
    echo '</a>';
    if ($row['TAKEOUT'] == 1) {
      echo '<br>', 'テイクアウト：可能';
    } else {
      echo '<br>', 'テイクアウト：不可';
    }
    if ($row['DELIVERY'] == 1) {
      echo '　', 'デリバリー：可能';
    } else {
      echo '　', 'デリバリー：不可';
    }

    echo '<br>', '店舗名：' . $row['rst_name'];
    echo '<br>', '評価数：' . $row['count'];
    echo '<br>', '評価平均：' . $row['ave'];
    echo '<br>', 'ジャンル：' . $row['genre'];
    echo '<br>', '平均予算：' . ($row['BUDGET_MAX'] + $row['BUDGET_MIN']) / 2 . '円';
    echo '</div>';
    $row = $rs->fetch_assoc(); //次の行へ
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