<?php
namespace quantox\controllers;
use quantox\interfaces;
use quantox\models\userSearch;
use quantox\views;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class indexController extends interfaces\controller{
    public function index() {
        session_start();
        $this->view = new views\indexView();
        return $this->view->render(['logged' => $this->isLoggedIndex()]);
        
    }
    
    private function isLoggedIndex(){
       return ((isset($_SESSION['loggedin'] ) && $_SESSION['loggedin'] 
        === true) && isset($_SESSION['username']) )
        ? htmlspecialchars($_SESSION['username']) 
                : 'guest';
    }
}