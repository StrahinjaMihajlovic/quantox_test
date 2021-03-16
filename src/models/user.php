<?php
namespace quantox\models;
use quantox\interfaces\absUser;
// class with responsibility of managing users entries.

class user extends absUser{
    protected $password_hash;
    public $name, $email;
    //populating the class params
    public function __construct($name = '', $email = '', $password = '') {
        parent::__construct();
        $this->name = filter_var($name,FILTER_SANITIZE_STRING);
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $this->password_hash = $password;
        
    }
    public function getValues() {
        return new \ArrayObject($this, \ArrayObject::ARRAY_AS_PROPS);
    }
    
    public function isPasswordCorrect($input){
        return password_verify($input, $this->password_hash);
    }
    
    //function responsible for validating data
    protected function validateUser(){
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
            $this->registerNewUser($this->name, $this->email, $this->password);
            } catch (PDOException $e){
                $reg = preg_match('*(email)*',$e->getMessage());
                echo preg_match('*(email)*',$e->getMessage()) == 1 ?
                'this user already exists, try using different email' :
                        'internal database error';
                return false;
            }
            return true;
        }else{
            echo $this->validateUser();
        }
    }
    
    protected function registerNewUser($username, $email, $password){
        $query = $this->dbconn->prepare("insert into users (username, email, pass_hash) values (:username, :email, :password)");
        $query->bindParam(":username", $username);
        $query->bindParam(":email", $email);
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $query->bindParam(":password", $passwordHash);
        
        return $query->execute();
    }
}