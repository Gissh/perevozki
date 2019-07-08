<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная</title>

    <?php include('scripts.php');
    include('php/connect.php')?>

</head>

<body>

    <?php include('navbar.php'); ?>

    <div class="container pt-5 pb-5">

        <?php
        
        $query=mysqli_query($link,"SELECT * FROM `news` WHERE `id`=".$_GET['id']);
        
        $row=mysqli_fetch_assoc($query);
        
        echo "<h1>".$row['new_header']."</h1>";
        
        if($_SESSION['admin']==1){
            echo "<div><span><a href='#' class='text-danger delNews' data-id=".$_GET['id'].">Удалить</a></span></div>";
        }
        
        echo "<span>".$row['body']."</span>";
        
        
        ?>

    </div>


</body>

<script>
    $('.delNews').click(function() {
        $.ajax({
            type: 'post',
            url: 'php/sendNews.php',
            data: {
                id: $('.delNews').attr('data-id'),
                method: 'delete'
            },
            success: function(data) {
                if (data != 'err') {
                    document.location.href = "index.php";
                }
            }

        });
    });

</script>

</html>
