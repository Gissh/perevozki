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

    <?php 
    
    $query=mysqli_query($link,'SELECT `car`.`id`,`car`.`owner`,`car`.`marka`,`car`.`shirina`,`car`.`visota`,`car`.`dlina`,`car`.`max_ves`,`car_type`.`name` FROM `car`,`car_type` WHERE `car_type`.`id`=`car`.`type` AND `car`.`owner`='.$_SESSION['id']);
    $array=[];
    
    while($row=mysqli_fetch_assoc($query)){
        $array[]=$row;
    }
    
    ?>

</head>

<body>

    <?php include('navbar.php'); ?>

    <div class="container pt-5 pb-5">
        <h3>Список моих машин</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Марка</th>
                    <th scope="col">Ширина</th>
                    <th scope="col">Высота</th>
                    <th scope="col">Длина</th>
                    <th scope="col">Тип</th>
                    <th scope="col">Макс. вес</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col">#</td>
                    <td scope="col"><input type='text' class='form-control addMarka'></td>
                    <td scope="col"><input type='number' class='form-control addShirina'></td>
                    <td scope="col"><input type='number' class='form-control addVisota'></td>
                    <td scope="col"><input type='number' class='form-control addDlina'></td>
                    <td scope="col"><select class='form-control addType'>
                            <?php
                        
                        $query=mysqli_query($link,'SELECT * FROM `car_type`');
                        
                        while($row=mysqli_fetch_assoc($query)){
                            echo '<option value='.$row['id'].'>'.$row['name'].'</option>';
                        }
                        
                        ?>
                        </select></td>
                    <td scope="col"><input type='number' class='form-control addVes'></td>
                    <td><a href='#' class='btnAddMenuItem'><img src='img/send.png'></a></td>
                    <td></td>
                </tr>
                <?php
                foreach($array as $row){
                    echo '<tr>
                    <th scope="row">'.$row['id'].'</th>
                    <td>'.$row['marka'].'</td>
                    <td>'.$row['shirina'].'</td>
                    <td>'.$row['visota'].'</td>
                    <td>'.$row['dlina'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['max_ves'].'</td>
                    <td><a href="#" class="editMenuLi"><img src="img/edit.png"></a></td>
                    <td><a href="#" class="deleteMenuItem" data-id='.$row['id'].'><img src="img/delete.png"></a></td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Сообщение</h5>
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
        setTimeout(function() {
            $('.modal').modal('hide');
        }, 2500);
    }



    $('.btnAddMenuItem').click(function() {
        $.ajax({
            type: 'post',
            url: 'php/myCars.php',
            data: {
                marka: $('.addMarka').val(),
                type: $('.addType option:selected').attr('value'),
                visota: $('.addVisota').val(),
                dlina: $('.addDlina').val(),
                shirina: $('.addShirina').val(),
                ves: $('.addVes').val(),
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

    $('.deleteMenuItem').click(function() {
        $(this).parent().parent().remove();

        $.ajax({
            type: 'post',
            url: 'php/myCars.php',
            data: {
                id: $(this).attr('data-id'),
                method: 'delete'
            },
            success: function(data) {
                $(this).parent().parent().remove();
                if (data != 'err') {
                    modalShow('Запись успешно удалена!');
                } else {
                    modalShow('Произошла ошибка, запись не была удалена!');
                }
            }
        });
    });

    $('.editMenuLi').click(function() {

        if ($('body').has('.editTr').length == 0) {
            var inputCopy = $('tbody>tr:first').clone();
            var thisParent = $(this).parent().parent();
            inputCopy.addClass('editTr');
            inputCopy.find('td:first').html(thisParent.find('th:first').text());
            inputCopy.find('td:last').html('<button type="button" class="btn btn-danger cancelBtn">Отмена</button>');
            inputCopy.find('td:eq(-2)').html('<button type="button" class="btn btn-warning applyBtn">Применить</button>');

            thisParent.css('display', 'none');
            thisParent.after(inputCopy);

            inputCopy.find('td').each(function(i, e) {
                i -= 1;
                if ($(this).children().is('input')) {
                    $(this).children('input').val(thisParent.find('td:eq(' + i + ')').text());
                } else if ($(this).children().is('select')) {
                    $(this).children('select').find('option').each(function() {
                        if ($(this).text() == thisParent.find('td:eq(' + i + ')').text()) {
                            $(this).attr('selected', '1');
                        }
                    });

                }
            });
        } else {
            $('.editTr').css('border', '2px solid red');
        }
    });

    $('body').on('click', '.cancelBtn', function() {
        $('.editTr').remove();
        $('tbody>tr').show();
    });

    $('body').on('click', '.applyBtn', function() {
        $.ajax({
            type: 'post',
            url: 'php/myCars.php',
            data: {
                id: $('.editTr>td:first').text(),
                marka: $('.editTr .addMarka').val(),
                type: $('.editTr .addType option:selected').attr('value'),
                visota: $('.editTr .addVisota').val(),
                dlina: $('.editTr .addDlina').val(),
                shirina: $('.editTr .addShirina').val(),
                ves: $('.editTr .addVes').val(),
                method: 'edit'
            },
            success: function(data) {
                if (data != 'err') {
                    modalShow('Запись успешно обновлена!');
                } else {
                    modalShow('Произошла ошибка, запись не была обновлена!');
                }
            }
        });

        $('.editTr').remove();
        $('tbody>tr').show();


    });

</script>

</html>
