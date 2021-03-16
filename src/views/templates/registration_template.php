<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if($array['isLogged']):?>
<p>You are logged in, please <a href='?controller=login&method=logout'>logout</a> from current account</p>
<?php else: ?>


<h2>Please, fill in the form below</h2>
<form method='post'>
    
    <label for='email'>E-mail</label>
    <input type='text' name="email">
    
    <label for='name'>name</label>
    <input type='text' name='name'>
    
    <label for='password'>enter the password</label>
    <input type='password' name ='password'>
    
    <label for='reapeat'>repeat the password</label>
    <input type='password' name='repeat'>
    <input type='submit'>
    
</form>
<?php endif; ?>