<div class="rst_detail">
    <h1 align="center">店舗詳細</h1>
    <?php
    require_once('db_inc.php');
    $uid  = $_SESSION['user_id'];
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
    // $rst_photo = $row['rst_photo'];//店舗の画像
    // $rst_photo1 = $row['rst_photo1'];//メニューの画像１
    // $rst_photo2 = $row['rst_photo2'];//メニューの画像２
    // $rst_photo3 = $row['rst_photo3'];//メニューの画像３
    // $uer_id = $row['user_id'];//登録したユーザ
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
    echo '<img src="img/rst' . $rst_id . '_photo1.jpg" height="280">';
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
    if ($restaurant== 1) {
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
    if ($rst_start_time_weekday != $rst_end_time_weekday ) {
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
    <h4>メニューの説明：</h4><?= $menu_detail ?>

    <?php
    if ($rst_address != null) {
        //マップ
        echo '<iframe width="80%" height="350pt" frameborder="0" scrolling="no"';
        echo "src='https://maps.google.com/maps?output=embed&hl=ja&q=<?=$rst_address?>'>";
        echo '</iframe>';
    }
    echo '<h4>コメント：</h4>';
    echo '<h5 align = "right">平均：'.$row['ave'].'　コメント数：'.$row['count'].'</h5>';


    /*$sql = "SELECT * FROM `t_review` WHERE `user_id`= $uid AND `rst_id` = $rst_id";
    $rs = $conn->query($sql);
      if ($rs) {
        $row = $rs->fetch_assoc();
        while ($row) {
            
        }
    }
    echo 'console.log('.$row['review_comment'].')';
    */
    
    ?>
</div>