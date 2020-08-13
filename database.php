<?php

require_once('config/env.php');

    // １・PDOをnewする
    // ２・データサーバーネーム、ユーザーネーム、パスワード、オプション（エラー）を指定
    // ３・try catchする
    // ４・catchでPDO例外を指定する

    //クラスにした場合のデータベースコネクション
    //クラスには共通して果たせる機能を置く

    Class dbc{

        // テーブルの名前
        protected $tableName;

        // データベースとのコネクション
        protected function dbConect(){

            try{
                $host = DB_HOST;
                $dbname = DB_NAME;
                $username = DB_USER;
                $password = DB_PASSW;
                $dsn ="mysql:host=$host;dbname=$dbname;charset=utf8";
            
                $dbh = new PDO($dsn,$username,$password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            } catch(PDOException $e){
                echo 'not'.$e -> getMessage();
            }
            return $dbh;
        }

        // テーブルデータを全部持ってくる
        public function getDataAll(){
            $dbh = $this->dbConect();   //このクラスのdbConectを使うよ、だからthisなんだよ

            $sql = "SELECT * FROM $this->tableName";
            $stmt = $dbh -> query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // 指定されたidのテーブルの列のデータを持ってくる
        public function select($id){
            $dbh = $this->dbConect();

            $stmt = $dbh->prepare("SELECT * FROM $this->tableName WHERE id = :id");
            $stmt->bindvalue(':id',(int)$id,PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt -> fetch(PDO::FETCH_ASSOC);

            if(!$result){           //配列があるかのチェック（データの有無）
                echo '配列がありません';
                exit();
            }
            return $result;
        }
        

    }
?>