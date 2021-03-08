<?php
include_once 'src/database/db.php';
session_start();
?>
<h1>Hello and welcome, <?php echo ((isset($_SESSION['loggedin'] ) && $_SESSION['loggedin'] 
        === true) && $_SESSION['username'] )
        ? htmlspecialchars($_SESSION['username']) 
                : 'guest' ?>
    , to this test project, please select something to do from button below:</h1>
<p>
    <a href="src/login.php">login</a>
</p>
