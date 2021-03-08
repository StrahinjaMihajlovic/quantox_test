<?php
class conn{
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'BacamINeDam';
    private $dbname = 'user_db';
    /* 
     * creating object for managing the database connections
     */
    private $dbconn;
    public function __construct(){
        try{
            //$this->dbconn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            $this->dbconn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            die('connection to database was unsuccessful with err ' . $e->getMessage());
        }
    }
    public function getConn(){
        return $this->dbconn;
    }
}
/* A class handling queries for database*/   
class dbQueries{
    /* @var $dbconn PDO*/
    private $dbconn;
    
    public function __construct() {
        $this->dbconn = (new conn())->getConn();
    }
    
    public function getUserByUsername($username){
        $query = $this->dbconn->prepare("select * from users where username = :username");
        $query->bindParam(':username', $username);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getUserByEmail($email){
        $query = $this->dbconn->prepare("select * from users where email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
