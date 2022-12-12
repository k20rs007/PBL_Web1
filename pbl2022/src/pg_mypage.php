<div class="pg_mypage">
  <h2>マイページ</h2>
  <?php
  require_once('db_inc.php');
  $uid  = $_SESSION['user_id'];     // ユーザIDでユーザを特定

  $sql = "SELECT * FROM t_user WHERE user_id='{$uid}'";
  $rs = $conn->query($sql);
  $row = $rs->fetch_assoc();
  if (!$rs) die('エラー: ' . $conn->error);
  if (isset($_SESSION['usertype_id'])) {
    if ($_SESSION['usertype_id'] === '1') {  //会員
      $url = "location.href='./?do=usr_add&user_id=" . $row['user_id'] . "'";

      echo '<div class = "myinf">';
      echo '<table>';
      echo '<tr><th>アカウント名</th><td>' . $row['user_name'] . '</td></tr>';
      echo '<tr><th>ID</th><td>' . $row['user_id'] . '</td></tr>';
      echo '</table>';
      echo '<button type="button" onclick="' . $url . '">アカウント情報変更</button>';
      echo '<br>';
      echo '<br>';
      echo '</div>';

      echo '<div class = "mypost">';
      echo '<h2>投稿した店舗一覧</h2>';

      //投稿した店舗一覧
      require_once('db_inc.php');
      define('MAX_ROWS', 9); //MAX_ROWS: 1ページに表示する最大行数

      $sql = "SELECT *, (SELECT COUNT(*) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as count,
      (SELECT ROUND(AVG(eval_point),1) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as ave 
      FROM t_rstinfo JOIN t_open ON t_rstinfo.rst_id = t_open.rst_id JOIN t_genre ON t_rstinfo.rst_id = t_genre.rst_id JOIN t_user ON t_rstinfo.user_id = t_user.user_id WHERE t_rstinfo.user_id = '{$uid}'";

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
          $japanese_f = $row['japanese_f']; //和食の可=1/否=0
          $western_f = $row['western_f']; //洋食の可=1/否=0
          $asian_f = $row['asian_f']; //アジアの可=1/否=0
          $curry = $row['curry']; //カレーの可=1/否=0
          $yakiniku = $row['yakiniku']; //焼肉の可=1/否=0
          $nabe = $row['nabe']; //鍋の可=1/否=0
          $restaurant = $row['restaurant']; //レストランの可=1/否=0
          $noodle = $row['noodle']; //麺類の可=1/否=0
          $cafe = $row['cafe']; //カフェの可=1/否=0
          $bread = $row['bread']; //パンの可=1/否=0
          $liquor = $row['liquor']; //お酒の可=1/否=0
          $others = $row['others']; //そのほかの可=1/否=0
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
      }

      echo '</div>';
      echo '<div class = "paging">';
      for ($j = 1; $j <= $max_page; $j++) {
        if ($j == $page) echo $j, ' ';
        else printf('<a href="?do=pg_mypage&p=%d">%d</a> ', $j, $j);
      }
      echo '</div>';
      echo '</div>';
    }


    echo '<div class = "adminmypage">';
    if ($_SESSION['usertype_id'] === '9') {  //管理者
      $url1 = "location.href='./?do=usr_add&user_id=" . $row['user_id'] . "'";
      $url2 = "location.href='./?do=usr_list'";
      echo '<button type="button" onclick="' . $url1 . '">管理者情報変更</buton>';
      echo '<button type="button" onclick="' . $url2 . '">アカウント一覧表示</buton>';
    }
    echo '</div>';
  }

  ?>
</div>