<?php

  require_once('blogFunction.php');

  $blog = new blog();

  //1.フォームから値を渡す
  //2.フォームから値を受け取る
  //3.バリデーションをする（データの方が正しいかなどを分別する）
  //4.トランザクション（データの移動の際、エラーが発生したら初期化すると言った仕組みを構築する事）
  //5.データをDBに登録する
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blog</title>
</head>
<body>
  <h1>データ一覧</h1>
  <p>index.html</p>
    <table>
        <thead>
            <tr>
                <td>タイトル</td>
                <td>内容</td>
                <td>日付</td>
            </tr>
        </thead>

        <tbody>
            <?php
                $allData = $blog->getDataAll();
                foreach($allData as $data){
            ?>
            <tr>
                <td><?php echo $data['title'];?></td>
                <td><?php echo $data['contents'];?></td>
                <td><?php echo $data['date'];?></td>
                <td><?php $blog->divideKind($data['kind'])?></td>     <!-- staticされており、インスタンス化しなくても使える -->
                <td><a href="detail.php?id=<?php echo $data['id'];?>">詳細</a></td>   <!-- GETにidをつける -->
                <td><a href="updataForm.php?id=<?php echo $data['id'];?>">編集</a></td>
                <td><a href="delete.php?id=<?php echo $data['id'];?>">消去</a></td>
            </tr>
            <?php }
            ?>
        </tbody>
    </table>
</body>
</html>