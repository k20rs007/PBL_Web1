<div class="rst_list">
  <h2>店舗一覧</h2>
  <?php
  require_once('db_inc.php');

  $sql = "SELECT *, (SELECT COUNT(*) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as count,
   (SELECT ROUND(AVG(eval_point),1) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as ave FROM t_rstinfo ORDER BY rst_id;";
  $rs = $conn->query($sql);
  if (!$rs) die('エラー: ' . $conn->error);
  ?>
  <table>
    <tr>
      <?php
      //架空の店舗ID（1～3）を使って一覧を作っている
      //実際の店舗情報は、DBから検索したものを使ってください
      //DBからデータを検索し、while文で複数の店舗の情報を一つずつ受けとり、画像とどもに表示する
      $row= $rs->fetch_assoc();
      while($row) {
        echo '<td>';
        echo '<a href="?do=rst_detail&rst_id=' .$row['rst_id'] . '">';
        echo '<img src="img/rst' . $row['rst_id'] . '_photo1.jpg" height="180">';
        echo '</a>';
        echo '<br>', '店舗名：' .$row['rst_name'] ;
        echo '<br>', '評価数：' .$row['count'] ;
        echo '<br>', '評価平均：' .$row['ave'] ;
        echo '<br>', 'ジャンル：' .$row['genre'] ;
        $row= $rs->fetch_assoc();//次の行へ
      }
      ?>
    </tr>
  </table>
</div>