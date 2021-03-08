<?php
class conn{
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'BacamINeDam';
    private $dbname = 'user_db';
    /* 
     * @param PDO $dbconn
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
    
    ?>
