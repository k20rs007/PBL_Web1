<h3>アカウント詳細</h3>
<?php
require_once('db_inc.php');
$uid  = $_GET['user_id'];     // ユーザIDでユーザを特定

$sql = "SELECT * FROM t_user WHERE user_id='{$uid}'";
$rs = $conn->query($sql);
if (!$rs) die('エラー: ' . $conn->error);

echo '<h2>アカウント情報</h2>';

echo '<table border=1 cellspacing="0">';
$row = $rs->fetch_assoc();
if ($row) {
    echo '<tr><th>ID</th><td>' . $row['user_id'] . '</td></tr>';
    echo '<tr><th>アカウント名</th><td>' . $row['user_name'] . '</td></tr>';
    echo '<tr><th>本名</th><td><input type="text" value="' . $row['user_name'] . '"></td></tr>';
    $codes = array('1' => '会員', '2' => 'ゲスト', '9' => '管理者');
    $i  = $row['usertype_id'];     // 数字のユーザ種別を取得
    echo '<tr><th>ユーザ種別</th><td>' . $codes[$i] . '</td></tr>';
}
echo '</table>';
echo '<form method="post">';
echo '<input type="submit" name="pass" value="パスワード初期化"/>';
echo '</form>';

echo '<button type="button" onchange>決定</button>';
?>

<?php
if (isset($_POST['pass'])) {
    $sql = "UPDATE `t_user` SET `password`='{$uid}' WHERE `user_id` = '{$uid}'";
    $rs = $conn->query($sql);
    echo '<h3>パスワードを初期化しました。</h3>';
}
?>