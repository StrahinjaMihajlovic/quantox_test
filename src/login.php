<?php
require_once 'database/db.php';
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    echo 'you already loged in, log <a href="/src/logout.php">out</a>';
}elseif($_SERVER['REQUEST_METHOD'] == "POST") {
    $dbquery = new dbQueries();
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');
    
    $user = $dbquery->getUserByEmail($email);
    
    if((isset($user)) && password_verify($password, $user['pass_hash'])){
        $_SESSION['username'] = $user['username'];
        $_SESSION['loggedin'] = true;
        header("Location: http://".$_SERVER['SERVER_NAME']);
    }else{
        echo "Error logging you in, try again";
    }
}
?>
<form action="<?php echo filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_URL)?>" method="POST">
    <label for="email">email</label>
    <input type='text' name='email'>
    
    <label for="username">password</label>
    <input type='password' name='password'>
    <input type='submit' name='submit'>
