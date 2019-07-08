<?php

include('connect.php');

session_start();

if($_POST['check']=='0'){

    $query=mysqli_query($link,'SELECT `id`,`admin` FROM `user` WHERE `login`="'.$_POST['login'].'" AND `password`="'.$_POST['password'].'"');

    if(mysqli_num_rows($query)!=0){

        $row=mysqli_fetch_assoc($query);
        $_SESSION['id']=$row['id'];
        $_SESSION['admin']=$row['admin'];
        echo 1;

    }else{

        echo 0;

    }
}else{
    session_destroy();
    header('Location: ../index.php');
}

?>
