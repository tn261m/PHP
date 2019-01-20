<?php
/*
 * ファイルパス：C:\xampp\htdocs\board\board2.php
 * ファイル名：board2.php
 * アクセスURL：http://localhost/PHP/Day_2/board/board2.php
 *
 * 今回の学習内容
 * ・全体の流れ(投稿があったか確認→投稿があれば入力チェックして書き込み→配列への格納→多次元連想配列の表示)
 * ・配列
 * ・while、foreach
 */
if (isset($_POST['send']) === true) {

    $name = $_POST['name'];
    $comment = $_POST['comment'];

    if ($name !== '' && $comment !== '') {

        $fp = fopen('data2.txt', 'a');
        if (flock($fp, LOCK_EX) === true) {
            fwrite($fp, $name . "\t" . $comment . "\n");
            flock($fp, LOCK_UN);
        }
    } else {
        echo '名前もしくは、コメントが記入されていません';
    }
}

// ファイルに書き込まれれたデータを読み込む
$fp = fopen('data2.txt', 'r');
$lineArray3 = [];
while ($res = fgets($fp)) {
    // 一行の書き込みを配列に分割
    $lineArray = explode("\t", $res);
    // 配列の個々の部分にアクセス　echo $lineArray[0];
    // 配列を連想配列にする。ラベル付き
    $lineArray2 = [
        'name' => $lineArray[0],
        'comment' => $lineArray[1]
    ];

    // 連想配列を多次元配列に入れる(エクセルのイメージをもつとわかりやすい)
    $lineArray3[] = $lineArray2;
}

fclose($fp);

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>掲示板</title>
</head>
<body>
	<form method="post" action="">
		名前 <input type="text" name="name" value="" /> コメント
		<textarea name="comment" rows="4" cols="20"></textarea>
		<input type="submit" name="send" value="書き込む" />
	</form>
	<!-- ここに、書き込まれたデータを表示する -->
<?php
//while_foreach_forのforを説明した後、foreachを説明
foreach($lineArray3 as $value ){
    //var_dump($value);
    echo "名前 :"     . $value["name"]    . "<br>";
    echo "コメント：" . $value["comment"] . "<br><br>";
}
?>
    </body>
</html>
