<?php

include('connect.php');

$query=mysqli_query($link,'SELECT `id` FROM `user` WHERE `login`="'.$_POST['login'].'" OR `mail`="'.$_POST['mail'].'"');

if(mysqli_num_rows($query)==0){
    $query=mysqli_query($link,'INSERT INTO `user`(`login`, `password`, `tel`, `mail`) VALUES ("'.$_POST['login'].'","'.$_POST['password'].'",'.$_POST['tel'].',"'.$_POST['mail'].'")');
    echo 1;
}else{
    echo 0;
}



?>
