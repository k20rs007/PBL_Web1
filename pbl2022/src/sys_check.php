<?php
  require_once('db_inc.php'); //データベースが必要なので読み込ませる
  $u = $_POST['user_id'] ;  
  $p = $_POST['pass'];
  $sql = "SELECT * FROM t_user WHERE user_id= '{$u}'  AND password='{$p}'";
  $rs = $conn->query($sql);
  if (!$rs) die('エラー: ' . $conn->error);
  $row= $rs->fetch_assoc();
  if ($row){ //Login succeeded
    $_SESSION['user_id']   = $row['user_id'];
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['usertype_id'] = $row['usertype_id'];
    header('Location:index.php');   
  }else{
    header('Location:?do=sys_login&error=1');
  }
?>