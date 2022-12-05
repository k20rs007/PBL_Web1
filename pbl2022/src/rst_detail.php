<div class="rst_detail">
    <h3>店舗詳細</h3>
    <?php
    $rst_id = $_GET['rst_id'];
    //以下の店舗情報は架空のものです。
    $rst_name = '居酒屋 ひなた';
    $rst_address ='福岡県福岡市中央区今泉2丁目3-31 プロペリスタ今泉Ⅱ　１階';
    $rst_info = '福岡市にある【ひなた】は路地裏にある隠れ家的居酒屋。一歩中に入ると、活気にあふれたスタッフの声が響く.';
    //実際の店舗情報はDB（$rst_id利用）から検索したもの（１行しかない）を使ってください
    //DBからデータを検索し、結果を変数$rst_name, $rst_address, $rst_info等に代入しておく
    echo '<img src="img/rst' . $rst_id. '_photo1.jpg" height="280">';
    ?>
    <h4>店舗名：</h4><?=$rst_name?></h4>
    <h4>店舗詳細：</h4><?=$rst_info?></h4>
    <h4>店舗住所：</h4><?=$rst_address?></h4>
    <?php
    if($rst_address != null){
        echo '<iframe width="80%" height="500pt" frameborder="0" scrolling="no"';
        echo "src='https://maps.google.com/maps?output=embed&hl=ja&q=<?=$rst_address?>'>";
        echo '</iframe>';
    }
    ?>
</div>
