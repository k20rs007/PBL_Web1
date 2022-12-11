<div class="rst_delete">
    <?php
    require_once('db_inc.php');
    if (isset($_GET['rst_id'])){
    $rst_id = $_GET['rst_id'];
    $sql = "DELETE FROM t_rstinfo WHERE rst_id='{$rst_id}'";
    echo $sql;
    $conn->query($sql);
    echo '<h2>削除しました。</h2>';
    //header('Location:?do=rst_list');
    }else{
    echo '<h2>削除する店舗IDは与えられていません</h2>';
    echo '<a href="?do=rst_list">戻る</a>';
    }
    ?>
</div>