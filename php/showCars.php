<?php
//SELECT `car_zakaz`.`id`,`car`.`marka`,`car_zakaz`.`date_from`,`car_zakaz`.`date_to`,c.`name` as "city_from",c1.`name` as "city_to" FROM `car`,`car_zakaz` LEFT JOIN `city` c ON `car_zakaz`.`city_from`=c.`id` LEFT JOIN `city` c1 ON `car_zakaz`.`city_to`=c1.`id` WHERE `car`.`id`=`car_zakaz`.`car_id`
require_once("connect.php");

$query='SELECT `car_zakaz`.`id`,`user`.`tel`,`car`.`marka`,`car`.`max_ves`,`car`.`shirina`,`car`.`visota`,`car`.`dlina`,`car_zakaz`.`date_from`,`car_zakaz`.`date_to`,c.`name` as "city_from",c1.`name` as "city_to" FROM `car`,`user`,`car_zakaz` LEFT JOIN `city` c ON `car_zakaz`.`city_from`=c.`id` LEFT JOIN `city` c1 ON `car_zakaz`.`city_to`=c1.`id` WHERE `car`.`id`=`car_zakaz`.`car_id` AND `user`.`id`=`car`.`owner` AND `car_zakaz`.`date_from`="'.$_POST['datefrom'].'" AND `car_zakaz`.`city_from`='.$_POST['cityfrom'].' AND `car_zakaz`.`city_to`='.$_POST['cityto'].' AND `car`.`type`='.$_POST['cartype'];

if($_POST['dateto']!=""){
    $query.=' AND `car_zakaz`.`date_to`="'.$_POST['dateto'].'"';
}

if($_POST['shirinaot']!=""){
    $query.=' AND `car`.`shirina`>='.$_POST['shirinaot'];
}

$post=mysqli_query($link,$query);
$array=[];

while($row=mysqli_fetch_assoc($post)){
    $array[]=$row;
}

echo json_encode($array);

?>
