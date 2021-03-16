<?php
namespace quantox\controllers;
use quantox\interfaces\controller;
use quantox\models\userSearch;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class searchController extends controller{
    public function index() {
        session_start();
        $isLogged = isset($_SESSION['loggedin']) 
                && ($_SESSION['loggedin'] === true);
        global $results;
        $this->model = new userSearch();
        if(filter_input(INPUT_GET, 'searchQuery') !== null){ 
            
            $results = $this->model->searchUsers(filter_input(INPUT_GET,
                'searchQuery', FILTER_SANITIZE_STRING));
        }
        
        $this->view = new \quantox\views\searchView();
        return $this->view->render(['isLogged' => $isLogged
                , 'results' => empty($results) ? [] : $results]);
    }
}