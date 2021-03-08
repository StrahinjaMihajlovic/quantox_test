<?php
include_once 'database/db.php';
// class with responsibility of managing users entries.
class User{
    private $password, $repPass, $dbQuery;
    public $name, $email;
    //populating the class params
    public function __construct($name, $email, $password, $repPass) {
        $this->name = filter_var($name,FILTER_SANITIZE_STRING);
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $this->password = $password;
        $this->repPass = $repPass;
        $this->dbQuery = new dbQueries();
    }
    //function responsible for validating data
    private function validateUser(){
        if((empty($this->name) || empty($this->password) || empty($this->email))){
            return 'please, fill in all inputs';
            
        }elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            return 'this is not a valid email, try again';
        }elseif($this->password !== $this->repPass){
            return 'password and repeated password does not match, try again';
        }
        else{
            return true;
        }
    }
    //this function registers the user into database
    public function registerUser(){
        if($this->validateUser() === true){
            try{
            $this->dbQuery->registerNewUser($this->name, $this->email, $this->password);
            } catch (PDOException $e){
                echo $e->getMessage();
            }
            return true;
        }else{
            echo $this->validateUser();
        }
    }
}