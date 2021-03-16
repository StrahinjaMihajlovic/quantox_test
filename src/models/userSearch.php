<?php
namespace quantox\models;
use quantox\models\User;
use PDO;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class userSearch extends \quantox\models\user{
    
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
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if(empty($result) || !$result){
            return false;
        }
        
        $this->email = $result['email'];
        $this->name = $result['username'];
        $this->password_hash = $result['pass_hash'];
        return true;
    }
    
     
    public function searchUsers($string){
        $query = $this->dbconn->prepare("select username, email from users where username like '%$string%' or email like '%$string%'");
        
        $query->execute();
        
        return $query->fetchAll();
    }
    
   
}