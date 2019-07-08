<?php

session_start();

require_once("connect.php");

if($_POST['method']=='add'){

    $query=mysqli_query($link,'INSERT INTO `news`(`owner`, `new_header`, `short_body`, `body`, `date`) VALUES ('.$_SESSION['id'].',"'.$_POST['name'].'","'.$_POST['short'].'","'.$_POST['body'].'",NOW())');
    if($query){
        echo mysqli_insert_id($link);
    }else{
        echo 'err';
    }

    
    
}else if($_POST['method']=='delete'){
        
    $query=mysqli_query($link,'DELETE FROM `news` WHERE `id`='.$_POST['id']);

    if($query){
        echo mysqli_insert_id($link);
    }else{
        echo 'err';
    }
    
}else if($_POST['method']=='edit'){
        
    $query=mysqli_query($link,'UPDATE `car` SET `marka`="'.$_POST['marka'].'",`shirina`='.$_POST['shirina'].',`visota`='.$_POST['visota'].',`dlina`='.$_POST['dlina'].',`type`='.$_POST['type'].',`max_ves`='.$_POST['ves'].' WHERE `id`='.$_POST['id']);

    if($query){
        echo mysqli_insert_id($link);
    }else{
        echo 'err';
    }
    
}



mysqli_close($link);


?>
