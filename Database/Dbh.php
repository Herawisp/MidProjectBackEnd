<?php
class Dbh { 
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbName = "midproject_bncc";
    private $pdo;
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=localhost;dbname=mydb", "root", "password");
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
    
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
