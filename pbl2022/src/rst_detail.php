<div class="rst_detail">
    <h3 align = "center">店舗詳細</h3>
    <?php
    require_once('db_inc.php');
    $rst_id = $_GET['rst_id'];
    $sql = "SELECT * FROM t_rstinfo INNER JOIN t_genre ON t_rstinfo.rst_id = t_genre.rst_id WHERE t_rstinfo.rst_id = $rst_id;";
    $rs = $conn->query($sql);
    if (!$rs) die('エラー: ' . $conn->error);
    $row= $rs->fetch_assoc();

    $rst_name = $row['rst_name'];//店舗名
    $rst_address = $row['rst_address'];//住所
    // $rst_start_time_weekday = $row['rst_start_time_weekday'];//平日の営業開始日
    // $rst_end_time_weekday = $row['rst_end_time_weekday'];//平日の営業終了日
    // $rst_start_time_holiday = $row['rst_start_tome_holiday'];//祝日の営業開始日
    // $rst_end_time_holiday = $row['rst_end_tome_holiday'];//祝日の営業終了日
    // $rst_num = $row['rst_num'];//店舗の電話番号
    $rst_info = $row['rst_info'];//店舗説明
    // $rst_map = $row['rst_map'];//店舗の位置情報？？
    // $rst_photo = $row['rst_photo'];//店舗の画像
    // $rst_photo1 = $row['rst_photo1'];//メニューの画像１
    // $rst_photo2 = $row['rst_photo2'];//メニューの画像２
    // $rst_photo3 = $row['rst_photo3'];//メニューの画像３
    // $uer_id = $row['user_id'];//登録したユーザ
    // $takeout = $row['takeout'];//テイクアウトの可=1/否=0
    // $delivery = $row['delivery'];//出前の可=1/否=0
    // $holiday_detal = $row['holiday_detal'];//休日の備考
    // $rst_url = $row['rst_url'];//店舗のホームページ
    // $menu_detail = $row['menu_detail'];//メニューの備考
    // $budget_max = $row['budget_max'];//価格帯（最大）
    // $budget_min = $row['budget_min'];//価格帯（最小）
    // $delivery_url = $row['delivery_url'];//出前サイトのURL
    // $japanese_f = $row['japanese_f'];//和食の可=1/否=0
    // $western_f = $row['western_f'];//洋食の可=1/否=0
    // $asian_f = $row['asian_f'];//アジアの可=1/否=0
    // $curry = $row['curry'];//カレーの可=1/否=0
    // $yakiniku = $row['yakiniku'];//焼肉の可=1/否=0
    // $nabe = $row['nabe'];//鍋の可=1/否=0
    // $restaurant = $row['restaurant'];//レストランの可=1/否=0
    // $noodle = $row['noodle'];//麺類の可=1/否=0
    // $cafe = $row['cafe'];//カフェの可=1/否=0
    // $bread = $row['bread'];//パンの可=1/否=0
    // $liquor = $row['liquor'];//お酒の可=1/否=0
    // $others = $row['others'];//そのほかの可=1/否=0
    
    echo '<img src="img/rst' . $rst_id. '_photo1.jpg" height="280">';
    ?>
    <h4>店舗名：</h4><?=$rst_name?></h4>
    <h4>店舗住所：</h4><?=$rst_address?></h4>
    <h4>定休日：</h4>
    <h4>Tel：</h4>
    <h4>店舗詳細：</h4><?=$rst_info?></h4>
    <h4>メニュー：</h4>
    <h4>メニューの説明：</h4>
    
    <?php
    if($rst_address != null)
    {
        echo '<iframe width="100%" height="300pt" frameborder="0" scrolling="no"';
        echo "src='https://maps.google.com/maps?output=embed&hl=ja&q=<?=$rst_address?>'>";
        echo '</iframe>';
    }
    echo 'コメント';
    ?>
</div>
