<?php
require_once 'database/db.php';
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    echo 'you already loged in';
    session_destroy();
}elseif($_SERVER['REQUEST_METHOD'] == "POST") {
    $dbquery = new dbQueries();
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    
    $user = $dbquery->getUserByUsername($username);
    
    if((isset($user)) && password_verify($password, $user['pass_hash'])){
        $_SESSION['username'] = $user['username'];
        $_SESSION['loggedin'] = true;
        header("Location: http://".$_SERVER['SERVER_NAME']);
    }
}
?>
<form action="<?php echo filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_URL)?>" method="POST">
    <label for="username">username</label>
    <input type='text' name='username'>
    
    <label for="username">password</label>
    <input type='password' name='password'>
    <input type='submit' name='submit'>
