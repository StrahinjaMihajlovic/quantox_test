<?php
include_once 'src/database/db.php';
session_start();
?>
<h1>Hello and welcome, <?php echo ((isset($_SESSION['loggedin'] ) && $_SESSION['loggedin'] 
        === true) && isset($_SESSION['username']) )
        ? htmlspecialchars($_SESSION['username']) 
                : 'guest' ?>
    , to this test project, please select something to do from button below:</h1>
<p><?php if((isset($_SESSION['loggedin'] ) && $_SESSION['loggedin'] 
        === true) && isset($_SESSION['username'])):?>
    <a href="src/logout.php?">logout</a>
    <?php else:?>
    <a href="src/login.php">login</a>
</p>
<?php endif;