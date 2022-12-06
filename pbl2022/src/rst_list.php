<div class="rst_list">
  <h2>店舗一覧</h2>
  <?php
  require_once('db_inc.php');
  define('MAX_ROWS', 9); //MAX_ROWS: 1ページに表示する最大行数
  $sql = "SELECT *, (SELECT COUNT(*) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as count,
   (SELECT ROUND(AVG(eval_point),1) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as ave FROM t_rstinfo ORDER BY rst_id";
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

<!--<h3>画像付きアカウント一覧(ページネーション)</h3>-->
<?php
/*
require_once('db_inc.php');
//define('MAX_ROWS', 4);//MAX_ROWS: 1ページに表示する最大行数

//結果の行数$num_rows, 最大ページ数$max_pageを計算する
$sql = "SELECT * FROM tbl_user ORDER BY urole,uid";
$rs = $conn->query($sql);
$num_rows = mysqli_num_rows($rs);
$max_page = ceil($num_rows / MAX_ROWS);

//表示したいページの番号、行番号を求める
$page = isset($_GET['p']) ? $_GET['p'] : 1;
if ($page < 1) $page = 1; //無効なページ番号を回避
if ($page > $max_page) $page = $max_page;
$offset = ($page - 1)  * MAX_ROWS;

//指定ページの結果を取り出す
$sql = sprintf("%s LIMIT %d OFFSET %d", $sql, MAX_ROWS, $offset);
$rs = $conn->query($sql);
if (!$rs) die('エラー: ' . $conn->error);
$codes = [1 => '学生', 2 => '教員', 9 => '管理者'];
$domain = 'kyusan-u.ac.jp';
echo '<table>';
while ($row = $rs->fetch_assoc()) {
  list('uid' => $uid, 'uname' => $name, 'urole' => $i) = $row;
  printf('<tr><td><img src="img/%s.png" height="120"></td>', $uid);
  printf('<td>%s<br>%s<br>%s@%s<br>%s</td></tr>', $uid, $name, $uid, $domain, $codes[$i]);
}
echo '</table>';
// ページ切り替えのリンクを作る
for ($j = 1; $j <= $max_page; $j++) {
  if ($j == $page) echo $j, ' ';
  else printf('<a href="?do=usr_listpage&p=%d">%d</a> ', $j, $j);
}*/
?>