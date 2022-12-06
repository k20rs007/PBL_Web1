<?php
require_once('db_inc.php');
if (isset($_GET['user_id'])){
   $user_id = $_GET['user_id'];
   $sql = "DELETE FROM t_user WHERE user_id='{$user_id}'";
   $conn->query($sql);
   header('Location:?do=usr_list');
}else{
  echo '<h2>削除するユーザIDは与えられていません</h2>';
  echo '<a href="?do=usr_list">戻る</a>';
}
?>