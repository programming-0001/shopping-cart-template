<?php
$_SESSION = array();
//セッション変数（秘密文書）を空にする
if (isset($_COOKIE[session_name()]) == true) {
    setcookie(session_name(), '', time() - 42000, '/');
    // パソコン側のセッションID（合言葉）をクッキーから削除する
}
@session_destroy();
//セッションを破棄

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/shop.css" media="all">
</head>

<body>
    <div id="container">
        <div id="header" style="">
            <!-- <h1><a href="http://www.67-cafe.com/" target="_blank"><img src="img/logo.png" alt="cafe67"></a></h1> -->
            <h1>青汁屋</h1>
        </div>

        <div id="menu">
            <ul>
                <li><a href="shop_list.php">商品一覧</a></li>
                <li><a href="shop_cartlook.php">カートを見る</a></li>
                <li><a href="mailto:info@example.com">お問い合わせ</a></li>
            </ul>
        </div>

        <div id="content">


            ログアウトしました。<br />
            <br />
            <a href="shop_list.php">商品一覧へ</a>




        </div>

        <div id="footer">
            <p>Copyright © 2012 cafe67 All Rights Reserved.</p>
        </div>

    </div>

</body>

</html>