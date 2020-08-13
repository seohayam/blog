<?php

require_once('blogFunction.php');
$blog = new blog();

$data = $_POST;
//バリデーショ＝＝＝＝＝＝＝＝＝＝＝＝
echo '<h1>バリデーション</h1>';

$blog->checkVali($data);

$blog->insert($data);
?>