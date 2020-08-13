<?php
// gitにあげる場合にはこのファイルだけをあげない様にするのがお作法

//envとはenviromentの略
// データベースの情報を定数にしまう

// 今回は$dsnのhostとdbnameに定数を変数を使って代入する
// $dsn ='mysql:host=localhost;dbname=blog;charset=utf8';

// 以下の四つを定数にして変数へと代入する
// $host =localhost
// $sbname = blog
// $username = 'blog_userName';
// $password = 'haruto';

// 定数は大文字
// 定数の定義は必ず大文字
define('DB_HOST','localhost');   //定数の定義の際にdefineを使う
define('DB_NAME','blog');
define('DB_USER','blog_userName');
define('DB_PASSW','haruto');





?>