<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>

    <?php include('scripts.php'); ?>
</head>

<body class="text-center">
    <div class='container' style='width:350px;margin-top:200px;'>

        <h2 class='pb-2'>Регистрация</h2>


        <div class="form-group">
            <input type="text" class="form-control loginInput" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Логин">
        </div>
        <div class="form-group">
            <input type="password" class="form-control passInput" id="exampleInputPassword1" placeholder="Пароль">
        </div>
        <div class="form-group">
            <input type="text" class="form-control mailInput" id="exampleInputPassword1" placeholder="Почта">
        </div>
        <div class="form-group">
            <input type="number" class="form-control telInput" id="exampleInputPassword1" placeholder="Номер телефона">
        </div>
        <div class="alert alert-danger" role="alert" style='display:none;'>
            Такой логин, телефон или почта уже заняты!
        </div>
        <button class="btn btn-primary sendReg">Отправить</button>


    </div>
</body>

<script>
    $('.sendReg').click(function() {
        $.ajax({
            type: 'post',
            url: 'php/register.php',
            data: {
                login: $('.loginInput').val(),
                password: $('.passInput').val(),
                tel: $('.telInput').val(),
                mail: $('.mailInput').val()
            },
            success: function(data) {

                if (data == 1) {
                    document.location.href = "index.php";
                } else {
                    $('.alert-danger').css('display', 'block');
                    setTimeout(function() {
                        $('.alert-danger').css('display', 'none');
                    }, 3000);
                }
            }
        });
    });

</script>

</html>
