<?php
require_once('database.php');

// ブログを動かす為だけの機能を使う
Class blog extends dbc{

    protected $tableName = 'table_blog';

    // 種類を分ける機能
    public function divideKind($kindNum){    //インスタンス化しなくても他で使える様になる(変化の少ないもの、つまり、静的なものをstatic化する)
            
        if($kindNum === '1'){
            echo '日常';
        }else if($kindNum === '2'){
            echo 'ブログ';
        }
    }

    // インサート
    public function insert($data){
        // INSERT and トランザクション========================

        $sql = 'INSERT INTO table_blog (title,contents,kind,statues) VALUES (:title,:content,:category,:publish_status)';

        //トランザクション3 step
        // 1.データベスコネクショ->beginTransaction();      プリペアする時
        // 2.データベースコネクション->commit();                      実行し終えたら
        // 3.データベースコネクション->rollBack();                      エラーだった場合



        $dbh = $this->dbConect();

        $dbh->beginTransaction();   //トランザクション

        try{

        $stmt = $dbh -> prepare($sql);

        $stmt -> bindValue(':title',$data['title'],PDO::PARAM_STR);
        $stmt -> bindValue(':content',$data['content'],PDO::PARAM_STR);
        $stmt -> bindValue(':category',$data['category'],PDO::PARAM_STR);
        $stmt -> bindValue(':publish_status',$data['publish_status'],PDO::PARAM_STR);

        $stmt -> execute();     //トランザクション

        $dbh->commit();

        echo '投稿完了';

        } catch(PDOException $e){

        $dbh->rollBack();       //トランザクション

        exit($e);
        }
    }

    // バリデーション
    public function checkVali($data){
        if(empty($data['title'])){
            exit('タイトルを入力してください');
        }
        if(mb_strlen($data['title']) > 191){    //191より文字列が多い時
            exit('191文字以内でお願いします');
        }
        
        if(empty($data['content'])){
            exit('テキストを入力してください');
        }
        
        if(empty($data['category'])){
            exit('種類を入力してください');
        }
        
        if(empty($data['publish_status'])){
            exit('公開、非公開を選択してください');
        }
    }

    // アップデート
    public function updata($data){

        $sql = "UPDATE $this->tableName
                    SET title = :title, contents = :content,kind = :category,statues = :publish_status
                        WHERE id = :id";

        $dbh = $this->dbConect();

        try{
        $dbh->beginTransaction();

        $stmt = $dbh->prepare($sql);

        $stmt -> bindValue(':id',$this->escape($data['id']),PDO::PARAM_STR);
        $stmt -> bindValue(':title',$this->escape($data['title']),PDO::PARAM_STR);
        $stmt -> bindValue(':content',$this->escape($data['content']),PDO::PARAM_STR);
        $stmt -> bindValue(':category',$this->escape($data['category']),PDO::PARAM_STR);
        $stmt -> bindValue(':publish_status',$this->escape($data['publish_status']),PDO::PARAM_STR);
        
        $stmt->execute();
        $dbh->commit();
        echo "更新完了";
        header("Location:index.php");
        
        } catch(PDOException $e){
            $dbh->rollBack();
            exit($e);
        }
    }

    // 消去     //ここでのidは、GETで受け取った物
    public function delete($id){
        if(empty($id)){
            exit('nothing your id');
        }

        $dbh = $this->dbConect();

        try{
        $sql = "DELETE FROM $this->tableName WHERE id = :id";

        $stmt = $dbh -> prepare($sql);

        $stmt -> bindValue(':id',(int)$id,PDO::PARAM_INT);

        $stmt -> execute();

        echo '消去完了';

        } catch(PDOException $e){
        exit($e);
        }
    }


    // エスケープ文字列処理     //配列を処理する事ができない
    public static function escape($s){
        return htmlspecialchars($s, ENT_QUOTES,"UTF-8");
    }
    



}


?>