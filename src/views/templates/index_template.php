<?php
namespace quantox\templates;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'src/database/db.php';

?>
<h1>Hello and welcome, <?php echo $logged ?>
    , to this test project, please select something to do from button below:</h1>
<p><?php if((isset($_SESSION['loggedin'] ) && $_SESSION['loggedin'] 
        === true) && isset($_SESSION['username'])):?>
    <a href="src/logout.php?">logout</a>
    <a href='src/search.php'>search</a>
    <?php else:?>
    <a href="src/login.php">login</a>
    <a href='src/registration.php'>Register</a>
    <a href='src/search.php'>search</a>
</p>
<?php endif;
