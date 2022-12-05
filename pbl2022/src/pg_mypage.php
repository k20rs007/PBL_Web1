<div class="pg_mypage">
  <h2>マイページ</h2>
  <?php
    require_once('db_inc.php');
    $uid  = $_SESSION['user_id'];     // ユーザIDでユーザを特定
    
    $sql = "SELECT * FROM t_user WHERE user_id='{$uid}'";
    $rs = $conn->query($sql);
    $row= $rs->fetch_assoc();
    if (!$rs) die('エラー: ' . $conn->error);
      if (isset($_SESSION['usertype_id'])){
        if ($_SESSION['usertype_id']==='1'){  //会員
          $url = "location.href='./?do=usr_add&user_id=".$row['user_id']."'";
          echo '<table>';
          echo '<tr><th>アカウント名</th><td>' . $row['user_name']. '</td></tr>';
          echo '<tr><th>ID</th><td>' . $row['user_id'] . '</td></tr>';
          echo '</table>';
          echo '<button type="button" onclick="'.$url.'">アカウント情報変更</button>';
          echo '<h2>投稿した店舗一覧</h2>';
        }
        if ($_SESSION['usertype_id']==='9'){  //管理者
          $url1 = "location.href='./?do=usr_add&user_id=".$row['user_id']."'";
          $url2 = "location.href='./?do=usr_list'";
          echo '<button type="button"  onclick="'.$url1.'">管理者情報変更</buton>';
          echo '<button type="button"  onclick="'.$url2.'">アカウント一覧表示</buton>';
        }
      }
  
  ?>
</div>