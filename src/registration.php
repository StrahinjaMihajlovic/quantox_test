<?php
include_once 'database/db.php';
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true):?>
<p>You are logged in, please <a href='login.php'>logout</a> from current account</p>
<?php else: ?>

<?php 
    if(filter_input(INPUT_SERVER,'REQUEST_METHOD') == "POST"){
        $dbquery = new dbQueries();
        $username = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $passwordRet = filter_input(INPUT_POST, 'repeat');
        try{
            if((empty($username) || empty($password) || empty($email))){
                echo 'please, fill all inputs';
            }elseif($password !== $passwordRet){
                echo 'password and repeated password do not match, please reenter your password';
            }else{
                $newUser = $dbquery->registerNewUser($username, $email, $password);
                echo 'you have successfuly registered, to log in, please go <a href="login.php">here</a>';
                
            }
        } catch (PDOException $e){
             switch($e->getCode()){
                 case 23000:
                     echo 'User with this email already exists, please try a different one or login with existing one';
             }
        }
    }
?>

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

