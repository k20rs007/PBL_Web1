<div class=rst_save>
<?php
require_once('db_inc.php');

if (isset($_POST['act'])){
    $user_id = $_SESSION['user_id'];
    $act = $_POST['act'];
    $rst_id = $_GET['rst_id'];
    $rst_name = $_POST['rst_name'];
    $rst_photo = $_POST['rst_photo'];
    $rst_info = $_POST['rst_info'];
    $start_time_weekday_hour = $_POST['start_time_weekday_hour'];
    $start_time_weekday_min = $_POST['start_time_weekday_min'];
    $start_time_weekday = $start_time_weekday_hour.":".$start_time_weekday_min.":00";

    $end_time_weekday_hour = $_POST['end_time_weekday_hour'];
    $end_time_weekday_min = $_POST['end_time_weekday_min'];
    $end_time_weekday = $end_time_weekday_hour.":".$end_time_weekday_min.":00";

    $start_time_holiday_hour = $_POST['start_time_holiday_hour'];
    $start_time_holiday_min = $_POST['start_time_holiday_min'];
    $start_time_holiday = $start_time_holiday_hour.":".$start_time_holiday_min.":00";

    $end_time_holiday_hour = $_POST['end_time_holiday_hour'];
    $end_time_holiday_min = $_POST['end_time_holiday_min'];
    $end_time_holiday = $end_time_holiday_hour.":".$end_time_holiday_min.":00";

    $tel_num_1 = $_POST['tel_num_1'];
    $tel_num_2 = $_POST['tel_num_2'];
    $tel_num_3 = $_POST['tel_num_3'];
    $tel_num = $tel_num_1."-".$tel_num_2."-".$tel_num_3;

    $budget_min = $_POST['budget_min'];
    $budget_max = $_POST['budget_max'];

    if(isset($_POST['japanese_f'])) {
      $japanese_f = 1;
    } else {
      $japanese_f = 0;
    }
    if(isset($_POST['western_f'])) {
      $western_f = 1;
    } else {
      $western_f = 0;
    }
    if(isset($_POST['asian_f'])) {
      $asian_f = 1;
    } else {
      $asian_f = 0;
    }
    if(isset($_POST['curry'])) {
      $curry = 1;
    } else {
      $curry = 0;
    }
    if(isset($_POST['yakiniku'])) {
      $yakiniku = 1;
    } else {
      $yakiniku = 0;
    }
    if(isset($_POST['nabe'])) {
      $nabe = 1;
    } else {
      $nabe = 0;
    }
    if(isset($_POST['restaurant'])) {
      $restaurant = 1;
    } else {
      $restaurant = 0;
    }
    if(isset($_POST['noodle'])) {
      $noodle = 1;
    } else {
      $noodle = 0;
    }
    if(isset($_POST['cafe'])) {
      $cafe = 1;
    } else {
      $cafe = 0;
    }
    if(isset($_POST['bread'])) {
      $bread = 1;
    } else {
      $bread = 0;
    }
    if(isset($_POST['liquor'])) {
      $liquor = 1;
    } else {
      $liquor = 0;
    }
    if(isset($_POST['others'])) {
      $others = 1;
    } else {
      $others = 0;
    }

    if(isset($_POST['monday'])) {
      $monday = 1;
    } else {
      $monday = 0;
    }
    if(isset($_POST['tuesday'])) {
      $tuesday = 1;
    } else {
      $tuesday = 0;
    }
    if(isset($_POST['wednesday'])) {
      $wednesday = 1;
    } else {
      $wednesday = 0;
    }
    if(isset($_POST['thursday'])) {
      $thursday = 1;
    } else {
      $thursday = 0;
    }
    if(isset($_POST['friday'])) {
      $friday = 1;
    } else {
      $friday = 0;
    }
    if(isset($_POST['saturday'])) {
      $saturday = 1;
    } else {
      $saturday = 0;
    }
    if(isset($_POST['sunday'])) {
      $sunday = 1;
    } else {
      $sunday = 0;
    }

    $holiday_detail = $_POST['holiday_detail'];
    $rst_url = $_POST['rst_url'];

    if(isset($_POST['takeout'])) {
      $takeout = 1;
    } else {
      $takeout = 0;
    }
    if(isset($_POST['delivery'])) {
      $delivery = 1;
    } else {
      $delivery = 0;
    }

    $delivery_url = $_POST['delivery_url'];
    $rst_address = $_POST['rst_address'];
    $map = "";                              //マップ情報はテキスト
    $photo1 = $_POST['photo1'];
    $photo2 = $_POST['photo2'];
    $photo3 = $_POST['photo3'];
    $menu_detail = $_POST['menu_detail'];

    $genre = "";


    echo $rst_id.",";
    /*
    echo $user_id.",";
    echo $rst_photo.",";
    echo $rst_info.",";
    echo $rst_name.",";
    echo $start_time_weekday_hour.",";
    echo $start_time_weekday_min.",";
    echo $start_time_weekday.",";

    echo $end_time_weekday_hour.",";
    echo $end_time_weekday_min.",";
    echo $end_time_weekday.",";

    echo $start_time_holiday_hour.",";
    echo $start_time_holiday_min.",";
    echo $start_time_holiday.",";

    echo $end_time_holiday_hour.",";
    echo $end_time_holiday_min.",";
    echo $end_time_holiday.",";

    echo $tel_num_1.",";
    echo $tel_num_2.",";
    echo $tel_num_3.",";
    echo $tel_num.",";

    echo $budget_min.",";
    echo $budget_max.",";
    
    echo $japanese_f.",";
    echo $western_f.",";
    echo $asian_f.",";
    echo $curry.",";
    echo $yakiniku.",";
    echo $nabe.",";
    echo $restaurant.",";
    echo $noodle.",";
    echo $cafe.",";
    echo $bread.",";
    echo $liquor.",";
    echo $others.",";
    
    echo $monday.",";
    echo $tuesday.",";
    echo $wednesday.",";
    echo $thursday.",";
    echo $friday.",";
    echo $saturday.",";
    echo $sunday.",";
    
    echo $holiday_detail.",";
    echo $rst_url.",";
    echo $takeout.",";
    echo $delivery.",";
    echo $delivery_url.",";
    echo $rst_address.",";
    echo $photo1.",";
    echo $photo2.",";
    echo $photo3.",";
    echo $menu_detail.",";
    
    echo $num.",";
    echo $rst_id;
    */
    

    //新規作成する場合
    $sql ="INSERT INTO t_rstinfo(rst_id,rst_name,rst_address,
    start_time_weekday,end_time_weekday,start_time_holiday,
    end_time_holiday,tel_num,rst_info,map,rst_photo,photo1,photo2,photo3,
    user_id,takeout,delivery,holiday_detail,rst_url,menu_detail,
    budget_min,budget_max,delivery_url,genre) VALUES 
    ('{$rst_id}','{$rst_name}','{$rst_address}','{$start_time_weekday}', '{$end_time_weekday}',
     '{$start_time_holiday}','{$end_time_holiday}',
     '{$tel_num}','{$rst_info}','{$map}','{$rst_photo}',
     '{$photo1}','{$photo2}','{$photo3}','{$user_id}','{$takeout}','{$delivery}',
     '{$holiday_detail}','{$rst_url}','{$menu_detail}','{$budget_min}','{$budget_max}',
     '{$delivery_url}','{$genre}')";
    if ($act=='update'){  //編集する場合
      $sql ="UPDATE t_rstinfo SET rst_id='{$rst_id}', rst_name='{$rst_name}', rst_address='{$rst_address}',
      start_time_weekday='{$start_time_weekday}', end_time_weekday='{$end_time_weekday}', 
      start_time_holiday='{$start_time_holiday}', end_time_holiday='{$end_time_holiday}',
      tel_num='{$tel_num}', rst_info='{$rst_info}', map='{$map}', rst_photo='{$rst_photo}',
      photo1='{$photo1}', photo2='{$photo2}', photo3='{$photo3}', user_id='{$user_id}',
      takeout='{$takeout}', delivery='{$delivery}', holiday_detail='{$holiday_detail}', rst_url='{$rst_url}',
      menu_detail='{$menu_detail}', budget_min='{$budget_min}', budget_max='{$budget_max}',
      delivery_url='{$delivery_url}', genre='{$genre}'";
    }
    //echo $sql;
    $conn->query($sql);
    echo '<h3>店舗が追加されました</h3>';
    $sql = "INSERT INTO t_genre(rst_id, japanese_f,western_f,asian_f,curry,yakiniku,nabe,restaurant,noodle,cafe,
    bread,liquor,others) VALUES
    ('{$rst_id}','{$japanese_f}','{$western_f}','{$asian_f}','{$curry}','{$yakiniku}','{$nabe}','{$restaurant}','{$noodle}','{$cafe}',
    '{$bread}','{$liquor}','{$others}')";
    $conn->query($sql);
    
}
?>
</div>