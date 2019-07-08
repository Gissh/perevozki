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

        <?php if(isset($_SESSION['id'])){
    echo '<h3>Добавить машину</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ваша машина</th>
                    <th scope="col">Город отправки</th>
                    <th scope="col">Город прибытия</th>
                    <th scope="col">Дата отправки</th>
                    <th scope="col">Дата прибытия</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col">#</td>
                    <td scope="col"><select class="form-control addCar">';

                        
                        $query=mysqli_query($link,'SELECT * FROM `car` WHERE `owner`='.$_SESSION['id']);
                        
                        while($row=mysqli_fetch_assoc($query)){
                            echo '<option value='.$row['id'].'>'.$row['marka'].'</option>';
                        }
                        
                        echo '
                        </select></td>
                    <td scope="col"><select class="form-control addCityFrom">';
                            
                        
                        $query=mysqli_query($link,'SELECT * FROM `city`');
                        
                        while($row=mysqli_fetch_assoc($query)){
                            echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                        }
                        
                        echo '
                        </select></td>
                    <td scope="col"><select class="form-control addCityTo">';
                        
                        $query=mysqli_query($link,'SELECT * FROM `city`');
                        
                        while($row=mysqli_fetch_assoc($query)){
                            echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                        }
                        
                        echo '
                        </select></td>
                    <td scope="col"><input type="date" class="form-control addDateFrom"></td>
                    <td scope="col"><input type="date" class="form-control addDateTo"></td>
                    <td scope="col"><a href="#" class="addMyCar"><img src="img/send.png"></a></td>
                </tr>

            </tbody>
        </table>';
        
        }?>

        <h3>Список машин</h3>
        <h5>Для отображения заполните фильтры</h5>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Город отправки</th>
                    <th scope="col">Город прибытия</th>
                    <th scope="col">Дата отправки</th>
                    <th scope="col">Дата прибытия</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col"><select class='form-control filterCityFrom'>
                            <?php
                        
                        $query=mysqli_query($link,'SELECT * FROM `city`');
                        
                        while($row=mysqli_fetch_assoc($query)){
                            echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                        }
                        
                        ?>
                        </select></td>
                    <td scope="col"><select class='form-control filterCityTo'>
                            <?php
                        
                        $query=mysqli_query($link,'SELECT * FROM `city`');
                        
                        while($row=mysqli_fetch_assoc($query)){
                            echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                        }
                        
                        ?>
                        </select></td>
                    <td scope="col"><input type='date' class='form-control filterDateFrom'></td>
                    <td scope="col"><input type='date' class='form-control filterDateTo'></td>
                    <td scope="col"><a href='#' class='applyFilters'><img src='img/send.png'></a></td>
                </tr>
                <tr>
                    <td scope="col"><select class='form-control typeCar'>
                            <?php
                        
                        $query=mysqli_query($link,'SELECT * FROM `car_type`');
                        
                        while($row=mysqli_fetch_assoc($query)){
                            echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                        }
                        
                        ?>
                        </select></td>
                    <td><input type='number' class='form-control shirinaot' placeholder="Ширина от"></td>
                    <td><input type='number' class='form-control shirinado' placeholder="Ширина до"></td>

                    <td><input type='number' class='form-control visotaot' placeholder="Высота от"></td>
                    <td><input type='number' class='form-control visotado' placeholder="Высота до"></td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Марка</th>
                    <th scope="col">Ширина</th>
                    <th scope="col">Высота</th>
                    <th scope="col">Длина</th>
                    <th scope="col">Макс. вес</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class='carList'>

            </tbody>
        </table>


    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Номер телефона</h5>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function modalShow(modalText) {
        $('.modal').modal('show');
        $('.modal .modal-body').text(modalText);
    }

    $('.addMyCar').click(function() {

        $.ajax({
            type: 'post',
            url: 'php/addCar.php',
            data: {
                car: $('.addCar option:selected').attr('value'),
                cityfrom: $('.addCityFrom option:selected').attr('value'),
                cityto: $('.addCityTo option:selected').attr('value'),
                datefrom: $('.addDateFrom').val(),
                dateto: $('.addDateTo').val(),
                method: 'add'
            },
            success: function(data) {
                console.log(data);
                if (data != 'err') {
                    $('.tbodySpecTable').append('<tr><th scope="row">' + data + '</th><td>' + $('.addSpecItemName').val() + '</td><td>' + $('.uchList option:selected').text() + '</td><td>' + $('.addNumberSpec').val() + '</td><td>' +
                        $('.addGodSpec').val() + '</td><td><button type = "button" class = "btn btn-success editMenuLi">Редактировать</button></td><td ><button type = "button" class = "btn btn-danger deleteMenuItem" data-id =' + data + '>Удалить</button></td> </tr>');
                    modalShow('Запись успешно добавлена!');

                } else {
                    modalShow('Произошла ошибка, запись не была добавлена!');
                }

            }
        });

    });

    $('.applyFilters').click(function() {
        $('.carList').empty();
        $.ajax({
            type: 'post',
            url: 'php/showCars.php',
            data: {
                cityfrom: $('.filterCityFrom option:selected').attr('value'),
                cityto: $('.filterCityTo option:selected').attr('value'),
                datefrom: $('.filterDateFrom').val(),
                dateto: $('.filterDateTo').val(),
                cartype: $('.typeCar option:selected').attr('value'),
                shirinaot: $('.shirinaot').val(),
                shirinado: $('.shirinado').val(),
                visotaot: $('.visotaot').val(),
                visotado: $('.visotado').val()
            },
            success: function(data) {
                console.log(data);
                $.each(JSON.parse(data), function(i, item) {
                    $('.carList').append('<tr><td></td><td>' + item.marka + '</td><td>' + item.shirina + '</td><td>' + item.visota + '</td><td>' + item.dlina + '</td><td>' + item.max_ves + '</td><td><a href="#" class="getPhone" data-tel="' + item.tel + '"><img src="img/phone.png"></a></td></tr>')
                });
            }
        });
    });

    $('body').on('click', '.getPhone', function() {
        modalShow($(this).attr('data-tel'));
    });

</script>

</html>
