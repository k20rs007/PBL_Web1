<div class="rst_list">
  <h2>店舗一覧</h2>
  <table><tr>
  <?php
  //架空の店舗ID（1～3）を使って一覧を作っている
  //実際の店舗情報は、DBから検索したものを使ってください
  //DBからデータを検索し、while文で複数の店舗の情報を一つずつ受けとり、画像とどもに表示する
  for ($rst_id=1; $rst_id < 4; $rst_id++){
    $rst_name = '店舗' . $rst_id;
    echo '<td>';
    echo '<a href="?do=rst_detail&rst_id=' . $rst_id . '">';
    echo '<img src="img/rst' . $rst_id. '_photo1.jpg" height="180">';
    echo '</a>';
    echo '<br>' , '店舗名：' . $rst_name;
  }
  ?>
  </tr></table>
</div>