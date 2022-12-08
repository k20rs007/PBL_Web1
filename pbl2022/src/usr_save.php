<div class=usr_save>
<?php
require_once('db_inc.php');
if (isset($_POST['act'])){
  $act = $_POST['act'];
  if ($_POST['pass_f']===$_POST['pass_s']){
    $user_id = $_SESSION['user_id'];
    //$usertype_id = $_POST['usertype_id'];
    $user_name = $_POST['user_name'];
    if($_POST['pass']===$_SESSION['password']) {
      if(!empty($_POST['pass_f'])) {
        $upass = $_POST['pass_f'];
      } else {
        $upass = $_SESSION['password'];
      }
      //新規作成する場合
      $sql ="INSERT INTO t_user(user_id,user_name,password,usertype_id) VALUES ('{$user_id}','{$user_name}','{$upass}')";
      if ($act=='update'){  //編集する場合
        $sql = "UPDATE t_user SET user_name='{$user_name}',password='{$upass}' WHERE user_id='{$user_id}'";
      }
      //echo $sql;
      $conn->query($sql);
      echo '<h3>アカウントが更新されました</h3>';
      $_SESSION['user_name'] = $user_name;
      $_SESSION['password'] = $upass;
    } else {
      echo '<h3>エラー：現在のパスワードが一致しないので登録できません</h3>';
    }
  }else{
    echo '<h3>エラー：パスワードが一致しないので登録できません</h3>';
  }
}
?>
</div>