<?php
namespace quantox\controllers;
use quantox\interfaces\controller;
use quantox\models\userSearch;
use quantox\views\loginView;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class loginController extends controller{
    public function index() {
        switch(filter_input(INPUT_GET, 'method', FILTER_SANITIZE_SPECIAL_CHARS)){
        case 'logout':   
            return $this->logout();
        case 'registration':
            return $this->registration();
        }
        session_start();
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
            echo 'you already loged in, log <a href="?controller=login&method=logout">out</a>';
        }
        elseif($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password');
            
            $this->model = new userSearch();
            
            if($this->model->getUserByEmail($email) && $this->model->isPasswordCorrect($password)){
                $_SESSION['username'] = $this->model->name;
                $_SESSION['loggedin'] = true;
                header("Location: http://".$_SERVER['SERVER_NAME']);

            }else{
               echo "Error logging you in, try again";
            }
        }
        
        $this->view = new loginView();
        return $this->view->render([]);
    }
    
    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header("Location:http://".$_SERVER["SERVER_NAME"]);
    }
    
    public function registration(){
       $isLogged = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
        
       if(filter_input(INPUT_SERVER,'REQUEST_METHOD') == "POST"){
           $this->model= 
              new \quantox\models\user(filter_input(INPUT_POST, 'name'
                      , FILTER_SANITIZE_SPECIAL_CHARS)
                      , filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)
                      , filter_input(INPUT_POST, 'password')
                      , filter_input(INPUT_POST, 'repeat'));
            if($this->model->registerUser()){
                 echo 'you have succesfully registered, please <a href="?controller=login">login</a> now';
             }
        
        }
        
        $this->view = new \quantox\views\registrationView();
        return $this->view->render(["isLogged" => $isLogged]);
    }
}