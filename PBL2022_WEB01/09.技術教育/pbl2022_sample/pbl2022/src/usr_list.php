<h3>アカウント一覧</h3>
<?php
require_once('db_inc.php');

$where = '1';
include('usr_search.php');

// 一覧するデータを検索するSQL
$sql = "SELECT * FROM t_user WHERE $where ORDER BY usertype_id, user_id";
$rs = $conn->query($sql);
if (!$rs) die('エラー: ' . $conn->error);

echo '<table border=1>';
// まず、ヘッド部分（項目名）を出力
echo '<tr><th>ユーザID</th><th>氏名</th><th>ユーザ種別</th><th colspan="2">操作</th></tr>';

// ユーザID（user_id）、ユーザ名(user_name)、ユーザ種別(usertype_id)を一覧表示
$row= $rs->fetch_assoc();
while ($row) {
  echo '<tr>';
  echo '<td>' . $row['user_id'] . '</td>';
  echo '<td>' . $row['user_name']. '</td>';
 // echo '<td>' . $row['usertype_id']. '</td>';
 $codes = array('1'=>'会員', '2'=>'ゲスト','9'=>'管理者');
 $i  = $row['usertype_id'];     // 数字のユーザ種別をで取得
 echo '<td>' . $codes[$i] . '</td>'; // ユーザ種別名を出力
 $user_id = $row['user_id'];
  echo '<td><a href="?do=usr_detail&user_id='.$user_id.'">詳細</a></td>';  
 echo '<td><a href="?do=usr_add&user_id='.$user_id.'">編集</a></td>'; 
 echo '<td><a href="?do=usr_delete&user_id='.$user_id.'">削除</a></td>';  
 echo '</tr>';
 $row= $rs->fetch_assoc();//次の行へ
}
echo '</table>';
?>