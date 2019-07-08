<?php

session_start();

require_once("connect.php");

if($_POST['method']=='add'){

    $query=mysqli_query($link,'INSERT INTO `car`(`owner`, `marka`, `shirina`, `visota`, `dlina`, `type`, `max_ves`) VALUES ('.$_SESSION['id'].',"'.$_POST['marka'].'",'.$_POST['shirina'].','.$_POST['visota'].','.$_POST['dlina'].','.$_POST['type'].','.$_POST['ves'].')');
    echo 'INSERT INTO `car`(`owner`, `marka`, `shirina`, `visota`, `dlina`, `type`, `max_ves`) VALUES ('.$_SESSION['id'].',"'.$_POST['marka'].'",'.$_POST['shirina'].','.$_POST['visota'].','.$_POST['dlina'].','.$_POST['type'].','.$_POST['ves'].')';
    if($query){
        echo mysqli_insert_id($link);
    }else{
        echo 'err';
    }

    
    
}else if($_POST['method']=='delete'){
        
    $query=mysqli_query($link,'DELETE FROM `car` WHERE `id`='.$_POST['id']);
    $query=mysqli_query($link,'DELETE FROM `car_zakaz` WHERE `car_id`='.$_POST['id']);

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
