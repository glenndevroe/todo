<?php
include_once("classes/Db.class.php");
include_once("classes/User.class.php");
include_once("helpers/Security.class.php");
    
if ( !empty($_POST) ) {
    

    
    $security = new Security();
    $security->password = $_POST['password'];
    $security->passwordConfirmation = $_POST['password_confirmation'];

    try{
        $security->passwordsAreSecure();

        $db = Db::getInstance();
        $user = new Student($db);
        $user->setEmail($_POST['email'] );
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->setUsername($_POST['username'] );
            
        try{
            $user->canIregister();
            $user->register($hash);
            $user->login();
        } catch(Exception $e) {
            $error = $e->getMessage();
        }

    } catch(Exception $e) {
        $error = $e->getMessage();
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Todo</title>
</head>
<body>

    <?php if(isset($error) ): ?>
        <?php echo $error ?>
    <?php endif; ?>

    <h1 class="logotekst">TODO</h1>
    <p class="tekstonderlogo">Task Manager</p>
    <div class="rand">
    <form action="" method="post" class="formlogin">

        <label class="label" for="username">Username</label><br>
        <input class="inputfield" type="text" name="username"><br>

        <label class="label" for="email">Email</label><br>
        <input class="inputfield" type="text" name="email"><br>

        <label class="label" for="password">Password</label><br>
        <input class="inputfield" type="password" name="password"><br>

        <label class="label" for="password_confirmation">Confirm Password</label><br>
        <input class="inputfield" type="password" name="password_confirmation"><br>

        <input class="button" type="submit" value="Register">

    </form>
    <a href="login.php" id="registerlink">You have an account? Log in here.</a>
</div>
</html>