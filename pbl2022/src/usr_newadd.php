<form action="" method="post">
    <table>
        <h2><br>アカウント新規登録</h2>
        <tr>
            <td>社員ID</td>
            <td>
                <input type="text" name="user_id">
            </td>
        </tr>
        <tr>
            <td>氏名</td>
            <td>
                <input type="text" name="user_name">
            </td>
        </tr>
        <tr>
            <td>表示名</td>
            <td>
                <input type="text" name="user_kana">
            </td>
        </tr>
    </table>
    <input type="submit" value="決定" onclick="">
</form>

<?php
require_once('db_inc.php');

if(isset($_POST['user_id'])) {
    $sql = "SELECT * FROM `t_user` WHERE user_id = '".$_POST['user_id']."'";
    $rs = $conn->query($sql);
    $row = $rs->fetch_assoc();;
    if(!$row) {
        $sql = "INSERT INTO `t_user`(`user_id`, `user_name`, `user_kana`, `password`, `usertype_id`) VALUES ('".$_POST['user_id']."','".$_POST['user_name']."','".$_POST['user_kana']."','".$_POST['user_id']."',1)";
        $rs = $conn->query($sql);
        header("Location:?do=usr_list");
    } else {
        echo '<span class = "txtred">同じ社員IDが既にあります。</span>';
    }
}

/*$sql ="INSERT INTO t_rstinfo(rst_id,rst_name,rst_address,
start_time_weekday,end_time_weekday,start_time_holiday,
end_time_holiday,tel_num,rst_info,rst_photo,photo1,photo2,photo3,
user_id,takeout,delivery,holiday_detail,rst_url,menu_detail,
budget_min,budget_max,delivery_url) VALUES 
('{$rst_id}','{$rst_name}','{$rst_address}','{$start_time_weekday}', '{$end_time_weekday}',
 '{$start_time_holiday}','{$end_time_holiday}',
 '{$tel_num}','{$rst_info}','{$rst_photo}',
 '{$photo1}','{$photo2}','{$photo3}','{$user_id}','{$takeout}','{$delivery}',
 '{$holiday_detail}','{$rst_url}','{$menu_detail}','{$budget_min}','{$budget_max}',
 '{$delivery_url}')";

 $conn->query($sql);*/

?>