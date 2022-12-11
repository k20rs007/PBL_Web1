<!DOCTYPE html> 
<html><head>
<meta http-equiv="Content-TYPE" content="text/html; charset=UTF-8">
<!--<link rel="stylesheet" href="https://unpkg.com/destyle.css@1.0.5/destyle.css">-->
<link rel="stylesheet" TYPE="text/css" href="css/style.css">
</head>
<body>
  <header>
  <div class="wrapper">

  <a href="#" align="left" onclick="history.back(); return false;">戻る</button>
  
  <?php
  if (isset($_SESSION['usertype_id'])){
    $menu = array();//メニュー項目：プログラム名（拡張子.php省略）
    if ($_SESSION['usertype_id']==='1'){  //社員
      $menu = array(   //社員メニュー
        //'ホーム'  => 'pb_home',
        '店舗一覧'  => 'rst_list',
        //'お気に入り'  => 'rst_favor',
        '店舗登録'  => 'rst_list',
        '店舗登録'  => 'rst_add',
      );
    }
    if($_SESSION['usertype_id']==='2') { //ゲスト
      $menu = array(   //ゲストメニュー
        //'ホーム'  => 'pb_home',
        '店舗一覧'  => 'rst_list',
        //'お気に入り'  => 'rst_favor',
      );
    }
    if ($_SESSION['usertype_id']==='9'){  //管理者
      $menu = array(   //管理者メニュー
        //'ホーム'  => 'pb_home',
        '店舗一覧'  => 'rst_list',
        //'店舗登録'  => 'rst_add',
        //'ユーザ一覧'  => 'usr_list',
        //'ユーザ登録'  => 'usr_add',
        
      );
    } 
    echo '<div>';
    echo '<a href="?do=pg_mypage">'.$_SESSION['user_name'].' </a>&nbsp;&nbsp;&nbsp;';
    foreach($menu as $label=>$action){ 
      echo  '<a href="?do=' . $action . '">' . $label . '</a>&nbsp;&nbsp;' ;
    }
    echo  '<a href="?do=sys_logout">ログアウト</a>&nbsp;&nbsp;' ;
    echo '</div>';

    
    
  }else{
    echo  '<a href="?do=sys_login">ログイン</a>' ;
  }
  ?>
</header>