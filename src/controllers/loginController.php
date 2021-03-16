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
        session_start();
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
            echo 'you already loged in, log <a href="/src/logout.php">out</a>';
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
}