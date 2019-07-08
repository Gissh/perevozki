<div class='container navbarYellow'>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php"><img src='img/logo.png'> Грузоперевозки</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="carslist.php">Найти машину</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Найти грузы</a>
                </li>

                <?php
                
                if(!isset($_SESSION['id'])){
                    echo '<li class="nav-item active">
                    <a class="nav-link" href="register.php">Регистрация</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Вход</a>
                </li>';
                }else{
                    echo '<li class="nav-item active">
                    <a class="nav-link" href="mycars.php">Мои машины</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="mygruz.php">Мои грузы</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="php/login.php">Выход</a>
                </li>';
                }
                
                if($_SESSION['admin']==1){
                    echo '<li class="nav-item active">
                    <a class="nav-link" href="news_create.php">Добавить новость</a>
                </li>';
                }
                
                ?>

            </ul>
        </div>
    </nav>

</div>
