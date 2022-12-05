<form action="?do=sys_check" method="post">
<div class="login">
  <h2>ログイン</h2>
  <table>
  <tr><td>ID：</td><td><input type="text" name="user_id"></td></tr>
  <tr><td>パスワード：</td><td><input type="password" name="pass"></td></tr>
  </table>
  <?php
    if(isset($_GET['error'])) {
      echo '<h3><font color="red">IDまたはパスワードが正しくありません</font></h3>';
    } else {
      echo '<h3></h3>';
    }
  ?>
  <input class="submitbutton" type="submit" value="ログイン">&nbsp;
</div>
</form>