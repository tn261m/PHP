<?php
/*
ファイルパス：C:\xampp\htdocs\csv\csv.php
ファイル名：csv.php
アクセスURL：http://localhost/PHP/Day_2/csv/csv.php

CSVファイルの読み込みは、PHP5.1以上だと、SplFileObjectを利用すると良い
fopen＋fgetcsvより処理が高速。ただ、最終行に、
 * array(1) {
 *   [0] =>
 *   NULL
 * }
こんなのが出るから、処理が必要
サンプルでは、if ( $line[0] === null ) continue; としていますが、
 * if ( is_null( $line[0] ) ) continue; とかでもOK。
あと、fgetcsvのサンプル内のpreg_matchの正規表現で、
 * ^[0-9]{1}$となっていますが、[0-9]が一文字を表しているので、{1}はいらないです。
説明として残しています。
*/

$file = new SplFileObject('read.csv');
$file->setFlags(SplFileObject::READ_CSV);

$i   = 1;
$flg = true;
foreach ($file as $line) {
    if ($line[0] === null) continue;
    $divDate = explode('-', $line[1]);
    // preg_match：正規表現によるマッチングを行う
    // trim：文字列の先頭および末尾にあるスペースを取り除く
    // checkdate：「月」「日」「年」の順番
    if (preg_match('/^[0-9]{4}$/', trim($line[0])) === 0 ||
        checkdate($divDate[1], $divDate[2], $divDate[0]) === false ||
        preg_match('/^[0-9]$/', $line[2]) === 0) {
        echo $i . '行目にエラーがあります<br>';
        $flg = false;
    }

    $i ++;
}
if ($flg === true) {
    echo '正常に終了しました';
}

//    $fp = fopen( "read.csv", "r" );
//
//    $i   = 1;
//    $flg = true;
//
//    while( $res = fgetcsv( $fp, "1024" ) ) {
//
//        $divDate = explode( "-", $res[1] );
//        if ( preg_match( '/^[0-9]{4}$/', trim( $res[0] ) )      === 0     ||
//             checkdate( $divDate[1], $divDate[2], $divDate[0] ) === false ||
//             preg_match( '/^[0-9]{1}$/', $res[2] )                 === 0 )
//        {
//            echo $i . "行目にエラーがあります<br>";
//            $flg = false;
//        }
//
//        $i++;
//
//    }
//    if ( $flg === true ) {
//        echo "正常に終了しました";
//    }

/*    正規表現:http://okumocchi.jp/php/re.php

        .   なんてもいい1文字を表す

        ^   先頭を意味する

        $   終わりを意味する

        *   直前の文字がなし、または1つ以上連続する

        +   直前の文字が最低でも1つ以上連続する

        ?   直前の文字がなし、または1つだけ

        |   |で区切られた文字列のいずれか

        []  []内の文字のいずれか
        [ABC] AかBかC

        ()  グループ化する
        (ABC)+
        ABCABC

        ABかCかどれか？
        (AB|C)

        W(indows|)

        {n}     n回一致する
        {n,}    n回以上一致する
        {m,n}   m回以上、n回以下に一致する

        a-z アルファベットaからzまで
        A-Z アルファベットAからZまで
        0-9 数字の0から9まで
        \d  数字の0から9まで
*/
