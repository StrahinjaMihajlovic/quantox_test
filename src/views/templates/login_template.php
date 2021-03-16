<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form action="<?php echo filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_URL)?>?controller=login" method="POST">
    <label for="email">email</label>
    <input type='text' name='email'>
    
    <label for="password">password</label>
    <input type='password' name='password'>
    <input type='submit' name='submit'>
</form>