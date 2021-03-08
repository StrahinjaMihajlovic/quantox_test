<?php
session_start();
include_once 'database/db.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true):?>

<link rel="stylesheet" href="assets/table.css" type="text/css">
<form method='get' action=" <?php filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_STRING) ?> ">
    <label for='searchQuery'>Search for users:</label>
    <input type='text' name='searchQuery'>
        
    <input type='submit'>
</form>
<?php

if(filter_input(INPUT_GET, 'searchQuery') !== null){ 
   $databaseQuery = new dbQueries();
   $results = $databaseQuery->searchUsers(filter_input(INPUT_GET, 'searchQuery', FILTER_SANITIZE_STRING));
?>

<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
    </tr>
    
<?php
   foreach($results as $result){
       echo '<tr>';

       echo '<td>'.$result[0].'</td>';
       echo '<td>'.$result[1].'</td>';

       echo '</tr>';
    }
    echo '</tr>';
}
?>
<?php else:?>
    <p>You have to be <a href='login.php'>logged in</a> to search users</p>
    
<?php endif; ?>


