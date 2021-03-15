<?php
namespace quantox\interfaces;

use quantox\interfaces\Model;
use quantox\database\conn;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class AbsUser implements Model{
    protected  $dbconn;
    
    public function __construct() {
        $this->dbconn = (new conn())->getConn();
    }
   
}