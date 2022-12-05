<div class="rst_list">
  <h2>店舗一覧</h2>
  <?php
  require_once('db_inc.php');

  $sql = "SELECT *, (SELECT COUNT(*) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as count,
   (SELECT ROUND(AVG(eval_point),1) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as ave FROM t_rstinfo ORDER BY rst_id;";
  $rs = $conn->query($sql);
  if (!$rs) die('エラー: ' . $conn->error);
  ?>
  <?php
  echo '<div class = "rst_grid">';
  //架空の店舗ID（1～3）を使って一覧を作っている
  //実際の店舗情報は、DBから検索したものを使ってください
  //DBからデータを検索し、while文で複数の店舗の情報を一つずつ受けとり、画像とどもに表示する
  $row = $rs->fetch_assoc();
  while ($row) {
    echo '<div class = "item">';
    echo '<a href="?do=rst_detail&rst_id=' . $row['rst_id'] . '">';
    echo '<img src="img/rst1_photo1.jpg">';
    echo '</a>';
    if($row['TAKEOUT'] == 1) {
      echo '<br>', 'テイクアウト：可能';
    } else {
      echo '<br>', 'テイクアウト：不可';
    }
    if($row['DELIVERY'] == 1) {
      echo '　', 'デリバリー：可能';
    } else {
      echo '　', 'デリバリー：不可';
    }
    
    echo '<br>', '店舗名：' . $row['rst_name'];
    echo '<br>', '評価数：' . $row['count'];
    echo '<br>', '評価平均：' . $row['ave'];
    echo '<br>', 'ジャンル：' . $row['genre'];
    echo '<br>', '平均予算：' . ($row['BUDGET_MAX'] + $row['BUDGET_MIN'])/2 . '円';
    echo '</div>';
    $row = $rs->fetch_assoc(); //次の行へ
  }
  echo '</div>';
  ?>
</div>