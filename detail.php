<?php

require_once('blogFunction.php');

$blog = new blog();

$id = $_GET['id'];

if(empty($id)){             //idがあるかチェック（データの有無）
    echo 'からじゃけん！';
    exit();
}

// 1-prepare
// 2-bind
// 3-excute
// 4-fetch

$result = $blog->select($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>
</head>
<body>
    <h1>詳細</h1>
    <h2>detail.php</h2>
    <p>id:<?php echo $result['id']; ?></p>
    <p>タイトル:<?php echo $result['title']; ?></p>
    <p>内容:<?php echo $result['contents']; ?></p>
    <p>種類:<?php echo $blog->dividekind($result['kind']); ?></p>
    <p>日付:<?php echo $result['date']; ?></p>
    <p>状況:<?php echo $result['statues']; ?></p>
</body>
</html>