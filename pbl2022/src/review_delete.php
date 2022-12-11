<?php
require_once('db_inc.php');
$rst_id = $_GET['rst_id'];
if (isset($_GET['review_id'])){
   $review_id = $_GET['review_id'];
   $sql = "DELETE FROM t_review WHERE review_id='{$review_id}'";
   $conn->query($sql);
   header('Location:?do=rst_detail&rst_id=' . $rst_id);
}else{
  echo '<h2>削除するユーザIDは与えられていません</h2>';
  echo '<a href="?do=rst_detail&rst_id=' . $rst_id . '">戻る</a>';
}
?>