<div class="rst_detail">
    <h1 align="center">店舗詳細</h1>
    <?php
    require_once('db_inc.php');
    if (isset($_SESSION['user_id'])) {
        $uid  = $_SESSION['user_id'];
    }
    $rst_id = $_GET['rst_id'];
    $sql = "SELECT *, (SELECT COUNT(*) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as count,
    (SELECT ROUND(AVG(eval_point),1) FROM t_review WHERE t_rstinfo.rst_id = t_review.rst_id) as ave 
    FROM t_rstinfo JOIN t_open ON t_rstinfo.rst_id = t_open.rst_id JOIN t_genre ON t_rstinfo.rst_id = t_genre.rst_id WHERE t_rstinfo.rst_id = $rst_id;";
    $rs = $conn->query($sql);
    if (!$rs) die('エラー: ' . $conn->error);
    $row = $rs->fetch_assoc();

    $rst_name = $row['rst_name']; //店舗名
    $rst_address = $row['rst_address']; //住所

    $rst_start_time_weekday = $row['start_time_weekday']; //平日の営業開始日
    $rst_end_time_weekday = $row['end_time_weekday']; //平日の営業終了日
    $rst_start_time_holiday = $row['start_time_holiday']; //祝日の営業開始日
    $rst_end_time_holiday = $row['end_time_holiday']; //祝日の営業終了日

    $tel_num = $row['tel_num']; //店舗の電話番号
    $rst_info = $row['rst_info']; //店舗説明
    $rst_photo = $row['rst_photo']; //店舗の画像
    $photo1 = $row['photo1']; //メニューの画像１
    $photo2 = $row['photo2']; //メニューの画像２
    $photo3 = $row['photo3']; //メニューの画像３
    $user_id = $row['user_id']; //登録したユーザ
    $holiday_detail = $row['holiday_detail']; //休日の備考
    $rst_url = $row['rst_url']; //店舗のホームページ
    $delivery_url = $row['delivery_url']; //デリバリーのホームページ
    $menu_detail = $row['menu_detail']; //メニューの備考
    $budget_max = $row['budget_max'];//価格帯（最大）
    $budget_min = $row['budget_min'];//価格帯（最小)
    $delivery_url = $row['delivery_url'];//出前サイトのURL
    $japanese_f = $row['japanese_f'];//和食の可=1/否=0
    $western_f = $row['western_f'];//洋食の可=1/否=0
    $asian_f = $row['asian_f'];//アジアの可=1/否=0
    $curry = $row['curry'];//カレーの可=1/否=0
    $yakiniku = $row['yakiniku'];//焼肉の可=1/否=0
    $nabe = $row['nabe'];//鍋の可=1/否=0
    $restaurant = $row['restaurant'];//レストランの可=1/否=0
    $noodle = $row['noodle'];//麺類の可=1/否=0
    $cafe = $row['cafe'];//カフェの可=1/否=0
    $bread = $row['bread'];//パンの可=1/否=0
    $liquor = $row['liquor'];//お酒の可=1/否=0
    $others = $row['others'];//そのほかの可=1/否=0
    if(isset($_SESSION['usertype_id']) && ($_SESSION['usertype_id']=='9' || $uid==$user_id)) {
        echo '<a href="?do=rst_add&rst_id='.$rst_id.'">編集</a>';
    }
    if(isset($_SESSION['usertype_id']) && ($_SESSION['usertype_id']=='9' || $uid==$user_id)) {
        $delete_url = "'?do=rst_delete&rst_id=".$rst_id."'";
        echo "<td><form method='post' action='?do=rst_delete&rst_id=".$rst_id."'' onsubmit='return deletecorrect()'>";
        echo '<input type="submit" value="削除" name="delete" />';
        echo '</form></td>';
    }
    //定休日文字列
    $rst_close = "";
    if ($row['sunday'] == 0) {
        $rst_close = $rst_close . "日 ";
    }
    if ($row['monday'] == 0) {
        $rst_close = $rst_close . "月 ";
    }
    if ($row['tuesday'] == 0) {
        $rst_close = $rst_close . "火 ";
    }
    if ($row['wednesday'] == 0) {
        $rst_close = $rst_close . "水 ";
    }
    if ($row['thursday'] == 0) {
        $rst_close = $rst_close . "木 ";
    }
    if ($row['friday'] == 0) {
        $rst_close = $rst_close . "金 ";
    }
    if ($row['saturday'] == 0) {
        $rst_close = $rst_close . "土 ";
    }
    if ($holiday_detail != null) {
        $rst_close = $rst_close . "(" . $holiday_detail . ")";
    }
    echo '<p align = "center">';
    if ($row['takeout'] == 1) {
        echo '<br>', 'テイクアウト：可能';
    } else {
        echo '<br>', 'テイクアウト：不可';
    }
    if ($row['delivery'] == 1) {
        echo '　　　　', 'デリバリー：可能';
    } else {
        echo '　　　　', 'デリバリー：不可';
    }
    echo '</p>';
    echo '<img class = "bigimg" src="img/' . $rst_photo . '">';
    ?>
    <h4>店舗名：</h4><?= $rst_name ?>
    <?php
    $rst_genre = "";
    if ($japanese_f == 1) {
        $rst_genre = $rst_genre . "日本食 ";
    }
    if ($western_f == 1) {
        $rst_genre = $rst_genre . "洋食 ";
    }
    if ($asian_f == 1) {
        $rst_genre = $rst_genre . "アジア ";
    }
    if ($curry == 1) {
        $rst_genre = $rst_genre . "カレー ";
    }
    if ($yakiniku == 1) {
        $rst_genre = $rst_genre . "焼肉 ";
    }
    if ($nabe == 1) {
        $rst_genre = $rst_genre . "鍋 ";
    }
    if ($restaurant == 1) {
        $rst_genre = $rst_genre . "レストラン ";
    }
    if ($noodle == 1) {
        $rst_genre = $rst_genre . "麺類 ";
    }
    if ($cafe == 1) {
        $rst_genre = $rst_genre . "カフェ ";
    }
    if ($bread == 1) {
        $rst_genre = $rst_genre . "パン ";
    }
    if ($liquor == 1) {
        $rst_genre = $rst_genre . "お酒 ";
    }
    if ($others == 1) {
        $rst_genre = $rst_genre . "その他 ";
    }
    ?>
    <h4>ジャンル：</h4><?= $rst_genre ?>

    <h4>店舗住所：</h4><?= $rst_address ?>
    <h4>開店時間：</h4>
    <?php
    if ($rst_start_time_weekday != $rst_end_time_weekday) {
        echo '平日　' . $rst_start_time_weekday . '～' . $rst_end_time_weekday;
    }
    if ($rst_start_time_holiday != $rst_end_time_holiday) {
        echo '<br>休日　' . $rst_start_time_holiday . '～' . $rst_end_time_holiday;
    }
    ?>
    <h4>定休日：</h4><?= $rst_close ?>
    <h4>Tel：</h4><?= $tel_num ?>
    <h4>店舗詳細：</h4><?= $rst_info ?>
    <h4>店舗URL：</h4><?php echo "<a href = '" . $rst_url . "'>" . $rst_url . "</a>";  ?>
    <h4>デリバリーURL：</h4><?php echo "<a href = '" . $delivery_url . "'>" . $delivery_url . "</a>";  ?>
    <h4>価格帯：</h4><?= $budget_min ?>円～<?= $budget_max ?>円
    <h4>メニュー(写真)：</h4>
    <div class="imgcontent">
        <?php
        if ($photo1 == $photo2) {
            if ($photo2 == $photo3) {
                if ($photo1 == "noimage" || $photo1 == "") {
                    echo '写真が登録されていません。';
                }
            }
        } else {
            if ($photo1 != "noimage") {
                echo '<img src="img/' . $photo1 . '" class = "smallimg">';
            }
            if ($photo2 != "noimage") {
                echo '<img src="img/' . $photo2 . '" class = "smallimg">';
            }
            if ($photo3 != "noimage") {
                echo '<img src="img/' . $photo3 . '" class = "smallimg">';
            }
        }
        ?>
    </div>
    <h4>メニューの説明：</h4><?= $menu_detail ?>

    <?php
    if ($rst_address != null) {
        //マップ
        echo '<iframe width="80%" height="350pt" frameborder="0" scrolling="no"';
        echo "src='https://maps.google.com/maps?output=embed&hl=ja&q=<?=$rst_address?>'>";
        echo '</iframe>';
    }
    echo '<table>';
    echo '<tr>';
    echo '<td>';
    echo '<h4>口コミ：</h4>';
    echo '</td>';
    echo '<td>';
    $ave = round($row['ave']*2, 0) / 2;
    echo '<p><span class="star5_rating" data-rate="'.$ave.'"></span></p>';
    echo '</td>';
    echo '<td>';
    echo "<h5>(" . $row['count'] . ")</h5>";
    echo '</td>';
    echo '</tr>';
    



    ?>
    <?php
    if (isset($_SESSION['usertype_id']) && $_SESSION['usertype_id'] == 1) {
        $sql = "SELECT * FROM t_review WHERE user_id= '" . $uid . "' AND rst_id = '" . $rst_id . "';";
        $rs = $conn->query($sql);
        $row = $rs->fetch_assoc();

        if ($row != null) {
            //UPDATE
            if (isset($_POST['point']) && isset($_POST['comment'])) {
                $sql = "UPDATE `t_review` SET `eval_point` = " . $_POST['point'] . ", `review_comment` = '" . $_POST['comment'] . "' WHERE `t_review`.`review_id` = " . $row['review_id'] . ";";
                $rs = $conn->query($sql);
                if (!$rs) die('エラー: ' . $conn->error);
            }
        } else {
            //INSERT
            if (isset($_POST['point']) && isset($_POST['comment'])) {
                $sql = "INSERT INTO `t_review`(`eval_point`, `review_comment`, `rst_id`, `user_id`) VALUES (" . $_POST['point'] . ",'" . $_POST['comment'] . "','" . $rst_id . "','" . $uid . "');";
                $rs = $conn->query($sql);
                if (!$rs) die('エラー: ' . $conn->error);
            }
        }

        //自分のコメントを表示
        $sql = "SELECT * FROM t_review WHERE user_id= '" . $uid . "' AND rst_id = '" . $rst_id . "';";
        $rs = $conn->query($sql);
        if (!$rs) die('エラー: ' . $conn->error);
        $row = $rs->fetch_assoc();

        $my_review_id = 0;
        $my_eval_point = 0;
        $my_review_comment = '';

        if (isset($row['eval_point'])) {
            $my_eval_point = $row['eval_point'];
            $my_review_id = $row['review_id'];
            if (isset($row['review_comment'])) {
                $my_review_comment = $row['review_comment'];
            }
        }

        //自分のコメント
        echo '<form action="?do=rst_detail&rst_id=' . $rst_id . '" method="post">';
        echo '<table>';
        echo '<tr>';
        echo '<td>';
        echo '<select id="ispoint" name="point">';
        for ($num = 0; $num <= 5; $num++) {
            if ($num == $my_eval_point) {
                echo '<option selected>' . $num . '</option>';
            } else {
                echo '<option>' . $num . '</option>';
            }
        }
        echo '</select>';
        echo '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>';
        echo '<textarea id="iscomment" name="comment" cols="110" rows="10" required> ' . $my_review_comment . ' </textarea>';
        echo '</td>';
        echo '</tr>';
        echo '</table>';
        echo '<div align="right"><input type="submit" value="投稿">';
        echo '</form>';
        echo "<form method='post' action='?do=review_delete&review_id=".$my_review_id."&rst_id=".$rst_id."' onsubmit='return deletecorrect()'>";
        echo '<input type="submit" value="削除" name="delete" /></div>';
        echo '</form>';


        //自分以外のコメント表示
        $sql = "SELECT * FROM t_review WHERE user_id != '" . $uid . "' AND rst_id = $rst_id;";
        $rs = $conn->query($sql);
        if (!$rs) die('エラー: ' . $conn->error);
        $row = $rs->fetch_assoc();
    } else {
        //自分以外のコメント表示
        $sql = "SELECT * FROM t_review WHERE rst_id = $rst_id;";
        $rs = $conn->query($sql);
        if (!$rs) die('エラー: ' . $conn->error);
        $row = $rs->fetch_assoc();
    }
    ?>
    <?php
    echo '<table border="1" style="border-collapse: collapse" cellpadding="10">';
    while ($row) {
        echo '<tr>';
        echo '<td>' . $row['eval_point'] . '</td>';
        echo '<td>' . $row['review_comment'] . '</td>';

        if (isset($_SESSION['usertype_id']) &&  $_SESSION['usertype_id'] == 9) {
            $delete_url = "'?do=review_delete&review_id=".$row['review_id']."&rst_id=".$row['rst_id']."'";
            echo "<td><form method='post' action='?do=review_delete&review_id=".$row['review_id']."&rst_id=".$row['rst_id']."' onsubmit='return deletecorrect()'>";
            echo '<input type="submit" value="削除" name="delete" />';
            echo '</form></td>';
        }
        echo '<tr>';
        $row = $rs->fetch_assoc();
    }

    ?>
    <script>
        function deletecorrect() {
            /* 確認ダイアログ表示 */
            var flag = confirm("本当に削除してもよろしいですか？\n\n削除したくない場合は[キャンセル]ボタンを押して下さい");
            /* send_flg が TRUEなら送信、FALSEなら送信しない */
            return flag;
        }
    </script>
    </table>


</div>