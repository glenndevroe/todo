<?php
session_start();

if(isset ($_SESSION['username'])){
    //echo "logged user is ".$_SESSION['username'];
} else {
    header('Location: login.php');
}

include_once("classes/Lijst.class.php");
include_once("classes/User.class.php");

if ( isset($_GET['search']) ){
    $search = $_GET['search'];
    $lijst = Lijst::searchPosts($search);
    echo $search;
    
} else {
    $lijst = Lijst::ShowLijst();
    
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
    
        <div class="row">
            <div class="col-sm-3" style="margin-top:90px;text-align:center;">
                <p><?php echo $_SESSION['username']; ?></p>
                <a href="logout.php">Logout</a>

                <div class=feed>

                    <?php foreach ($lijst as $l): ?>
                        <div class="feed__lijst" id="<?php echo $l['lijst_id']; ?>">
                            <a href="details.php?lijst=<?php echo $l['id']; ?>">
                            <p class="feed__text"><?php echo $l['text']; ?></p>
                            
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
        </div>
    

</body>
</body>
</html>