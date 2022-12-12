<div class="usr_list">
    <h3>アカウント一覧</h3>
    <?php
    require_once('db_inc.php');

    $where = '1';
    //include('usr_search.php');

    if (isset($_POST['searchname'])) {
        $sql = "SELECT * FROM t_user WHERE user_name LIKE '%" . $_POST['searchname'] . "%' ORDER BY usertype_id, user_id";
    } else {
        // 一覧するデータを検索するSQL
        $sql = "SELECT * FROM t_user WHERE $where ORDER BY usertype_id, user_id";
    }

    $rs = $conn->query($sql);
    if (!$rs) die('エラー: ' . $conn->error);
    ?>

    <form action="?do=usr_list" method="post">
        <input type="search" name="searchname" value="">
        <button type="submit">検索</button>
    </form>


    <?php
    echo '<table border=1 cellspacing="0">';
    // まず、ヘッド部分（項目名）を出力
    //echo '<tr><th>ユーザID</th><th>氏名</th><th>ユーザ種別</th><th colspan="2">操作</th></tr>';
    echo '<tr><th>ユーザID</th><th>氏名</th><th>アカウント名</th><th colspan="3">操作</th></tr>';

    // ユーザID（user_id）、ユーザ名(user_name)、ユーザ種別(usertype_id)を一覧表示
    $row = $rs->fetch_assoc();
    while ($row) {
        echo '<tr>';
        echo '<td>' . $row['user_id'] . '</td>';
        echo '<td>' . $row['user_name'] . '</td>';
        echo '<td>' . $row['user_kana'] . '</td>';
        // echo '<td>' . $row['usertype_id']. '</td>';
        //$codes = array('1'=>'会員', '2'=>'ゲスト','9'=>'管理者');
        //$i  = $row['usertype_id'];     // 数字のユーザ種別をで取得
        //echo '<td>' . $codes[$i] . '</td>'; // ユーザ種別名を出力
        $user_id = $row['user_id'];
        $detail_url = "'?do=usr_detail&user_id=" . $user_id . "'";
        $delete_url = "'?do=usr_delete&user_id=" . $user_id . "'";
        echo '<td><button onclick=location.href=' . $detail_url . '>詳細表示</button></td>';
        echo '<td><form method="post" action="?do=usr_delete&user_id=' . $user_id . '" onsubmit="return submitChk()">';
        echo '<input type="submit" value="削除" name="delete" />';
        echo '</form></td>';
        echo '</tr>';
        $row = $rs->fetch_assoc(); //次の行へ
    }
    echo '</table>';
    echo '<form method="post" action="?do=usr_newadd">';
    echo '<input type="submit" value="新規登録">';
    echo '</form>';

    ?>
</div>

<script>
    function submitChk() {
        /* 確認ダイアログ表示 */
        var flag = confirm("本当に削除してもよろしいですか？\n\n削除したくない場合は[キャンセル]ボタンを押して下さい");
        /* send_flg が TRUEなら送信、FALSEなら送信しない */
        return flag;
    }
</script>