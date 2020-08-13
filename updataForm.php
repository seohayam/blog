<?php
require_once('blogFunction.php');
$blog = new blog();

$id =$_GET['id'];

$result = $blog->select($id);
var_dump($result);

$category = (int)$result['kind'];
$staues = (int)$result['statues'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BlogForm</title>
</head>
<body>
    <h2>ブログ更新フォーム</h2>
    <h3>updataForm.php</h3>
    <form action="updata.php" method="POST">
        <p>ブログタイトル：</p>
        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
        <input type="text" name="title" value="<?php echo $result['title']; ?>">
        <p>ブログ本文：</p>
        <textarea name="content" id="content" cols="30" rows="10"><?php echo $result['contents']; ?></textarea>
        <br>
        <p>カテゴリ：</p>
        <select name="category">
            <option value="1" <?php if($category === 1)echo "selected" ?> >日常</option>
            <option value="2" <?php if($category === 2)echo "selected" ?>>プログラミング</option>
        </select>
        <br>
        <input type="radio" name="publish_status" value="1" <?php if($staues === 1)echo "checked" ?>>公開
        <input type="radio" name="publish_status" value="2" <?php if($staues === 2)echo "checked" ?>>非公開
        <br>
        <input type="submit" value="送信">
    </form>
    
</body>
</html>