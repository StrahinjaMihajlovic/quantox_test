<?php
namespace quantox\views;
use quantox\interfaces\view;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class indexView implements view{
    public function render($array) {
        $logged = $array['logged'];
        include_once('templates/index_template.php');
    }
}