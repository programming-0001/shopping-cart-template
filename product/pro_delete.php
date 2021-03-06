<?php
session_start();
// 自動で合言葉を設定
session_regenerate_id(true);
//合言葉を毎回変更
if (isset($_SESSION['login']) == false) {
    print 'ログインされていません。<br />';
    print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
} else {
    print $_SESSION['staff_name'];
    print 'さんログイン中<br />';
    print '<br />';
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>


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
        $sql = 'SELECT name,image FROM mst_product WHERE code=?';
        //1件のレコードに絞られる為、この後whileループは使わない
        $stmt = $dbh->prepare($sql);
        $data[] = $pro_code;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        //$stmtから1レコード取り出す
        $pro_name = $rec['name'];
        $pro_image_name = $rec['image'];

        //<<--3.データベースから切断-->>
        $dbh = null;

        if ($pro_image_name == '') {
            $disp_image = '';
        } else {
            $disp_image = '<img src="./image/' . $pro_image_name . '">';
            //もし画像があれば、表示するためのHTMLタグを準備
        }
    } catch (Exception $e) {
        print 'ただいま障害により大変ご迷惑をお掛けしております。';
        exit();
    }

    ?>

    商品削除<br />
    <br />
    商品コード<br />
    <?php print $pro_code; ?>
    <br />
    商品名<br />
    <?php print $pro_name; ?>
    <br />
    <?php print $disp_image; ?>
    <br />
    この商品を削除してよろしいですか？<br />
    <br />
    <form method="post" action="pro_delete_done.php">
        <input type="hidden" name="code" value="<?php print $pro_code; ?>">
        <input type="hidden" name="image_name" value="<?php print $pro_image_name; ?>">
        <!-- PHPの変数に入っているものを表示する（これは非表示） -->
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>

</body>

</html>