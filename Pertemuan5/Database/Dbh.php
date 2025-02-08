<?php
class Dbh { //Database Handler
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbName = "midproject_bncc"; //Datbase Name
    private $pdo;

    protected function connect() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbName}"; //DataSourceName
        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //Default manggil dalam bentuk array assosiatif
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
        return $this->pdo;
    }

    protected function close(){
        $this->pdo = null;
    }
}
