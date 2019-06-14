<?php
    include($_SERVER['DOCUMENT_ROOT'].'/php/connect.php');
    include($_SERVER['DOCUMENT_ROOT'].'/modules/menuSql.php');

    // Подключение стилей Бутстрап
    $link_bootstrap = '<link rel="stylesheet"   
                        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
                        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
                        crossorigin="anonymous">
                        <link rel="stylesheet" href="style.css">
                        ';
    $title = 'Каталог товаров';

    include($_SERVER['DOCUMENT_ROOT'].'/modules/head.php');

    // Вытаскиваем из базы данных товары
    $qr = "SELECT * FROM `catalog`";
    $res = mysqli_query($db, $qr);
    
    // Заносим все товары в массив
    $template = [];
    while ( $row = mysqli_fetch_assoc($res) ) {
        $template[] = $row;
    }

    // function d($array) {
    //     echo '<pre>';
    //     print_r($array);
    //     echo '</pre>';
    // }

    // d($template);


    
?>

<!-- <!doctype html> -->
<!-- <html lang="ru"> -->
  <!-- <head> -->
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="style.css"> -->
    <!-- <title>Добавление товара</title> -->
  <!-- </head> -->
  <!-- <body> -->
    <div class="container">
        <h1><?=$title?></h1>
        <div class="row">
            <?php   // Подключение левой колонки меню для админа
                include($_SERVER['DOCUMENT_ROOT'].'/modules/adminMenu.php');  
            ?>   
            <!-- <div class="col-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Добавить товар</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Каталог товаров</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Заказы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Клиенты</a>
                    </li>
                </ul>
            </div> -->
            <div class="col-9">

                <?php foreach($template as $ind => $val): ?>

                    <div class="card" style="width: 18rem;">
                        <img src="/images/catalog/<?=$val['pic']?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?=$val['name']?></h5>
                            <p class="card-text">Артикул <b><?=$val['article']?></b></p>
                            <p class="card-text"><?=$val['description']?></p>
                            <a href="/admin/change.php?id=<?=$val['id']?>" class="btn btn-primary">Изменить товар</a>
                        </div>
                    </div>

                <?php endforeach ?>

            </div>
            
        </div>
        
    </div>

    

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/modules/footer.php');
?>