<?php
session_start();
// 自動で合言葉を設定
session_regenerate_id(true);
//合言葉を毎回変更
if (isset($_SESSION['member_login']) == false) {
    print 'ようこそゲスト様　';
    print '<a href="member_login.html">会員ログイン</a><br />';
} else {
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様　';
    print '<a href="member_logout.php">ログアウト</a><br />';
}
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
            <div id="content-inside" style="padding: 20px;">




                <?php

                try {

                    $pro_code = $_GET['procode'];
                    //入力枠からではない為、サニタイジングは不必要

                    //<<--1.データベースに接続（PDO）-->>
                    //pro_add_doneと同じ
                    $dsn = 'mysql:dbname=shop;host=localhost';
                    $user = 'root';
                    $password = '';
                    $dbh = new PDO($dsn, $user, $password);
                    $dbh->query('SET NAMES utf8');

                    //<<--2.SQL文指令-->>
                    $sql = 'SELECT name,price,image FROM mst_product WHERE code=?';
                    //1件のレコードに絞られる為、この後whileループは使わない
                    $stmt = $dbh->prepare($sql);
                    $data[] = $pro_code;
                    $stmt->execute($data);

                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                    //$stmtから1レコード取り出す
                    $pro_name = $rec['name'];
                    $pro_price = $rec['price'];
                    $pro_image_name = $rec['image'];

                    //<<--3.データベースから切断-->>
                    $dbh = null;

                    if ($pro_image_name == '') {
                        $disp_image = '';
                    } else {
                        $disp_image = '<img src="../product/image/' . $pro_image_name . '">';
                        //もし画像があれば、表示するためのHTMLタグを準備
                    }
                ?>
                    <button>
                        <?php
                        print '<a href="shop_cartin.php?procode=' . $pro_code . '">カートに入れる</a>';
                        ?>
                    </button>
                    <br /><br />
                <?php
                } catch (Exception $e) {
                    print 'ただいま障害により大変ご迷惑をお掛けしております。';
                    exit();
                }

                ?>

                商品情報参照<br />
                <br />
                商品コード<br />
                <?php print $pro_code; ?>
                <br />
                商品名<br />
                <?php print $pro_name; ?>
                <br />
                価格<br />
                <?php print $pro_price; ?>円
                <br />
                <?php print $disp_image; ?>
                <br />
                <br />
                <form>
                    <input type="button" onclick="history.back()" value="戻る">
                </form>



            </div>
        </div>


        <div id="footer">
            <p>Copyright © 2012 cafe67 All Rights Reserved.</p>
        </div>

    </div>

</body>

</html>