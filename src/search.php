<?php
session_start();
include_once 'database/db.php';
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true):?>
<form method='get' action=" <?php filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_STRING) ?> ">
    <label for='searchQuery'>Search for users:</label>
    <input type='text' name='searchQuery'>
    
    <input type='submit'>
</form>
<?php else : ?>
<?php endif; ?>

