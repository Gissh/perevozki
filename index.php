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

    <div class="container pt-5">

        <div class='cards-box'>

            <div class="card text-center" style="width: 18rem;">
                <img src="img/truck.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Более триллиарда машин в наличии!<br><br> Доставка за наносекунду!</p>
                    <a href="carslist.php" class="btn btn-primary">Найти машину!</a>
                </div>
            </div>

            <div class="card text-center" style="width: 18rem;">
                <img src="img/box.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Более триллиарда клиентов в наличии!<br><br>Перевози что то тоннами!</p>
                    <a href="#" class="btn btn-primary">Найти груз!</a>
                </div>
            </div>
        </div>

    </div>

    <div class='container pt-3'>
        <h1 class='text-center'>Новости</h1>

        <div class="row mb-2 mt-4">

            <?php
        
        $query=mysqli_query($link,"SELECT * FROM `news`");
        
        while($row=mysqli_fetch_assoc($query)){
            echo '<div class="col-md-6">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0">'.$row['new_header'].'</h3>
                        <div class="mb-1 text-muted">'.$row['date'].'</div>
                        <p class="card-text mb-auto">'.$row['short_body'].'</p>
                        <a href="news.php?id='.$row['id'].'" class="stretched-link">Читать дальше</a>
                    </div>
                </div>
            </div>';
        }
        
        
        ?>

        </div>
    </div>

</body>

</html>
