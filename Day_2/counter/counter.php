<?php
/*
 * ファイルパス：C:\xampp\htdocs\counter\counter.php
 * ファイル名：counter.php
 * アクセスURL：http://localhost/PHP/Day_2/counter/counter.php
 *
 * 今回の学習内容
 * ・全体の流れ(ファイルの存在確認→値の取得→インクリメントしてからファイルに書き込み)
 * ・file_put_contents、file_get_contents
 *
 * //今までの書き方
 * $fp = fopen( "count.txt" ,"r" );
 * $res = fgets( $fp );
 *
 * //file_get_contents
 * $res = file_get_contents( "count.txt" ) ;
 *
 * //改行も関係なく読み込んでくれる。
 * $data = file_get_contents( "hoge.txt" );
 * var_dump( $data );
 * exit;
 */

/*
 * fwrite( $fp , $data );
 * file_put_contents( "ファイル名" , "書き込みデータ");
 */

// ファイルが無ければcount.txtを作って0を入れてください、という処理
if (is_file('count.txt') === false) file_put_contents('count.txt', 0);

$num = intval(file_get_contents('count.txt'));
$num ++;
file_put_contents('count.txt', $num);

echo 'count:' . $num;
