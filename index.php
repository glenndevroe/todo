<?php
session_start();

if(isset ($_SESSION['username'])){
    echo "logged user is ".$_SESSION['username'];
} else {
    header('Location: login.php');
}

//include_once("classes/Post.class.php");
include_once("classes/User.class.php");

/*if ( isset($_GET['search']) ){
    $search = $_GET['search'];
    $posts = Post::searchPosts($search);
    echo $search;
    
} else {
    $posts = Post::ShowPosts();
    
}*/

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo</title>
</head>
<body>



</body>
</body>
</html>