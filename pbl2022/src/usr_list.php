<div class="usr_list">
<h3>アカウント一覧</h3>
<?php
require_once('db_inc.php');

$where = '1';
//include('usr_search.php');

// 一覧するデータを検索するSQL
$sql = "SELECT * FROM t_user WHERE $where ORDER BY usertype_id, user_id";
$rs = $conn->query($sql);
if (!$rs) die('エラー: ' . $conn->error);

echo '<table border=1>';
// まず、ヘッド部分（項目名）を出力
//echo '<tr><th>ユーザID</th><th>氏名</th><th>ユーザ種別</th><th colspan="2">操作</th></tr>';
echo '<tr><th>ユーザID</th><th>氏名</th><th>アカウント名</th><th colspan="3">操作</th></tr>';

// ユーザID（user_id）、ユーザ名(user_name)、ユーザ種別(usertype_id)を一覧表示
$row= $rs->fetch_assoc();
while ($row) {
  echo '<tr>';
  echo '<td>' . $row['user_id'] . '</td>';
  echo '<td>' . $row['user_name']. '</td>';
  echo '<td>' . $row['user_name']. '</td>';
 // echo '<td>' . $row['usertype_id']. '</td>';
 //$codes = array('1'=>'会員', '2'=>'ゲスト','9'=>'管理者');
 //$i  = $row['usertype_id'];     // 数字のユーザ種別をで取得
 //echo '<td>' . $codes[$i] . '</td>'; // ユーザ種別名を出力
 $user_id = $row['user_id'];
  echo '<td><a href="?do=usr_detail&user_id='.$user_id.'">詳細</a></td>';  
  echo '<td><a href="?do=usr_add&user_id='.$user_id.'">編集</a></td>'; 
//  echo '<td><a href="?do=usr_delete&user_id='.$user_id.'">削除</a></td>';  
  echo '<td><form method="post" action="?do=usr_delete&user_id='.$user_id.'" onsubmit="return submitChk()">';
  echo '<input type="submit" value="削除" name="test" onclick="return confirm_test()" />';
  echo '</form></ td>';
  echo '</tr>';
 $row= $rs->fetch_assoc();//次の行へ
}
echo '</table>';

?>
</div>

<script>
function submitChk () {
    /* 確認ダイアログ表示 */
    var flag = confirm ( "本当に削除してもよろしいですか？\n\n削除したくない場合は[キャンセル]ボタンを押して下さい");
    /* send_flg が TRUEなら送信、FALSEなら送信しない */
    return flag;
}
 
// function confirm_test() { // 問い合わせるボタンをクリックした場合
//     document.getElementById('popup').style.display = 'block';
//     return false;
// }
 
//y function delete_func() { // OKをクリックした場合
//     var delete_id = `<?php if(isset($_POST['test'])){ echo $_POST['test']; }else{ echo null; }?>`;
//     window.location.href = `?do=usr_delete&user_id=${delete_id}`;
// }
 
// function no_func() { // キャンセルをクリックした場合
//     document.getElementById('popup').style.display = 'none';
//     location.reload(true);
// }
</script>

<!-- <div id="popup" style="width: 200px;displa: none;padding: 30px 20px;border: 2px solid #000;margin: auto;">
    本当に削除しますか？<br />
    <button id="ok" onclick="no_func()">キャンセル</button>
    <button id="no" onclick="delete_func()">削除する</button>
</div> -->