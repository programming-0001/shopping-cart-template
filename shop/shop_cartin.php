<?php
session_start();
// 自動で合言葉を設定
session_regenerate_id(true);
//合言葉を毎回変更
if (isset($_SESSION['member_login']) == false) {
    print 'ようこそゲスト様　';
    print '<a href="member_login.html">会員ログイン</a><br />';
    print '<br />';
} else {
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様　';
    print '<a href="member_logout.php">ログアウト</a><br />';
    print '<br />';
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>サンプル</title>
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


            <?php

            try {

                $pro_code = $_GET['procode'];
                //入力枠からではない為、サニタイジングは不必要

                if (isset($_SESSION['cart']) == true) {
                    $cart = $_SESSION['cart'];
                    $quantity = $_SESSION['quantity'];
                    if (in_array($pro_code, $cart) == true) {
                        print 'その商品はすでにカートに入っています。<br />';
                        print '<a href="shop_list.php">商品一覧へ戻る</a>';
                        exit();
                    }
                }
                $cart[] = $pro_code;
                $quantity[] = 1;
                $_SESSION['cart'] = $cart;
                $_SESSION['quantity'] = $quantity;
                //$_SESSION => データを入れておけば、どのページからでもそのデータが見れる

            } catch (Exception $e) {
                print 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }

            ?>

            カートに追加しました。<br />
            <br />
            <a href="shop_list.php">商品一覧に戻る</a>


        </div>

        <div id="footer">
            <p>Copyright © 2012 cafe67 All Rights Reserved.</p>
        </div>

    </div>
</body>

</html>