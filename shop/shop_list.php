<?php
session_start();
// 自動で合言葉を設定
session_regenerate_id(true);
//合言葉を毎回変更
if (isset($_SESSION['member_login']) == false) {
    print 'ようこそゲスト様　';
    print '<a href="member_login.html">会員ログイン</a><br />';
    // print '<br />';
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
    <link rel="stylesheet" href="css/shop_list.css" media="all">
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
            <h2>商品一覧</h2>

            <?php

            try {

                //<--1.データベースに接続（PDO）-->
                //pro_add_doneと同じ
                $dsn = 'mysql:dbname=shop;host=localhost';
                $user = 'root';
                $password = '';
                $dbh = new PDO($dsn, $user, $password);
                $dbh->query('SET NAMES utf8');

                //<--2.SQL文指令-->
                $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
                //「商品の名前を全て取り出せ」
                $stmt = $dbh->prepare($sql);
                $stmt->execute();

                //<--3.データベースから切断-->
                $dbh = null;

                // print '商品一覧<br/><br/>';
            ?>
                <div class="parent">
                    <div class="child1">
                        <h3>
                            <br><br>
                            <?php
                            while (true) {
                                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                                //$stmtから1レコード取り出す
                                if ($rec == false) {
                                    break;
                                    //もうデータが無ければ、ループから脱出
                                }
                                print '<a href="shop_product.php?procode=' . $rec['code'] . '">';
                                // リンクを設置
                                print $rec['name'];
                                print '</a>';
                            ?>
                        </h3>
                        <p>
                            <br>
                            カフェロクナナのケーキは毎日手づくり。<br>
                            季節ごとにいろんな味を楽しめます。<br><br><br>
                            <div style="margin-left: 150px;">
                                <?php print $rec['price'] . '円'; ?>
                            </div>
                        </p>
                        <br><br>

                        <h3>
                        <?php
                            }
                        ?>
                        </h3>
                    </div>


                    <div class="child2" style="">
                        <img src="img/img_cake.jpg" style="margin-top: 60px;" alt="">
                        <img src="img/img_cake.jpg" style="margin-top: 70px;" alt="">
                    </div>
                    <!-- <div style="float: right;">
                <p><img src="img/img_cake.jpg" style="float: right;" alt="" align="right"></p>
                </div> -->
                </div>

            <?php
                print '</br>';
                // print '<a href="shop_cartlook.php">カートを見る</a><br />';
            } catch (Exception $e) {
                print 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }
            ?>

            <!-- <h3>おいしいケーキでほっと一息</h3>
            <p>
                カフェロクナナのケーキは毎日手づくり。<br>
                季節ごとにいろんな味を楽しめます。</p>
            <h3>まるでリビングにいるような気分</h3>
            <p><img src="img/img_living.jpg" alt="">
                あかるい光が差し込む店内は、居心地バツグン。<br>
                じぶんの家にいるような気分でお過ごしください。</p> -->
            <div id="footer">
                <p>Copyright © 2012 cafe67 All Rights Reserved.</p>
            </div>

        </div>
    </div>

</body>

</html>