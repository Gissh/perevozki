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

    <div class="container pt-5 pb-3">

        <label>Название</label>
        <input type='text' class='form-control news_name'>

        <label>Краткое описание</label>
        <textarea class='form-control news_short_body'></textarea>

        <label>Полное описание</label>
        <textarea class='form-control news_body'></textarea>

        <button class='btn btn-primary mt-3 sendNews'>Отправить</button>

    </div>


</body>

<script>
    $('.sendNews').click(function() {
        $.ajax({
            type: 'post',
            url: 'php/sendNews.php',
            data: {
                name: $('.news_name').val(),
                short: $('.news_short_body').val(),
                body: $('.news_body').val(),
                method: 'add'
            },
            success: function(data) {
                alert(data);
            }

        });
    });

</script>

</html>
