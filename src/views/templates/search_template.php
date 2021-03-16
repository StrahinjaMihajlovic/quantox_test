<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if($array['isLogged']):?>
<link rel="stylesheet" href="/src/assets/table.css" type="text/css">
<form method='get' action=" <?php filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_STRING) ?>">
    <label for='searchQuery'>Search for users:</label>
    <input type='text' name='searchQuery'>
    <input type='hidden' name='controller' value="search">
        
    <input type='submit'>
</form>



<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
    </tr>
    
<?php
   foreach($array["results"] as $result){
       echo '<tr>';

       echo '<td>'.$result[0].'</td>';
       echo '<td>'.$result[1].'</td>';

       echo '</tr>';
    }
    echo '</table>';

?>
<?php else:?>
    <p>You have to be <a href='?controller=login'>logged in</a> to search users</p>
    
<?php endif; ?>


