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
    $title = 'Изменение товара';


    include($_SERVER['DOCUMENT_ROOT'].'/modules/head.php');

    // Переменные
    $sizes = [
        "xs" => "XS",
        "s" => "S",
        "m" => "M",
        "l" => "L",
        "xl" => "XL",
        "xxl" => "XXL",
        "xxxl" => "XXXL",
        "bxl" => "BXL",
        "bxxl" => "BXXL",
        "bxxxl" => "BXXXL",
    ];

    // Запрос к базе данных для вывода категорий товаров
    $qr_cat = "SELECT * FROM `categories` WHERE `parent_category` > 0";
    $res_cat = mysqli_query($db, $qr_cat);
    $template = [];
    while ( $row = mysqli_fetch_assoc($res_cat) ) {
        $template[] = $row;
    }
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
                <p class="color-red size26">Все поля обязательны для заполнения!</p>
                <form method="POST" enctype="multipart/form-data" action="/admin/handlers/add_product.php">  
                <!-- enctype="multipart/form-data"   это для того, чтоб загружать в этой форме файлы -->
                    <div class="form-group">
                        <label for="product-name">Название товара</label>
                        <input type="text" name="product_name" class="form-control" id="product-name" placeholder="Куртка зимняя">
                    </div>
                    <div class="form-group">
                        <label for="product-price">Цена</label>
                        <input type="text" name="product_price" class="form-control" id="product-price" placeholder="2500 руб">
                    </div>
                    <div class="form-group margin-bottom40">
                        <label for="article">Артикул</label>
                        <input type="text" name="article" class="form-control" id="article" placeholder="12345">
                    </div>
                    <div class="custom-file margin-bottom40">
                        <input type="file" name="pic" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Выбрать файл для картинки товара...</label>
                    </div>
                    
                    <label for="category">Категория товара</label>
                    <select name="category" id="category" class="form-control margin-bottom20">
                        <?php foreach($template as $ind => $val): ?>
                        <?php
                            $qr_parent = "SELECT * FROM `categories` WHERE `id` = '{$val['parent_category']}'";
                            $res_parent = mysqli_query($db, $qr_parent);
                            $row_parent = mysqli_fetch_assoc($res_parent);
                            // Будем брать в каждой иттерации имя родительской категории $row_parent['name']
                            // и подставлять в название категории, чтобы АДМИН понимал в какую категорию определять товар
                        ?> 
                        <option value="<?=$val['id']?>"> <?=$row_parent['name'].' -- '.$val['name']?> </option>
                        <?php endforeach ?>
                    </select>
                    <div class="form-group margin-bottom20">
                        <label for="description">Краткое описание товара</label>
                        <textarea name="description" class="form-control" id="description" rows="3" placeholder="Краткое описание товара"></textarea>
                    </div>

                    <!-- Размеры товара -->
                    <p class="margin-bottom0">Размеры</p>
                    <div class="form-control wrapper-block margin-bottom40">

                        <?php

                            // Размеры в цифрах
                            for ( $i = 10; $i < 65; $i++ ) {
                                
                                echo "
                                    <div class='form-check'>
                                        <input class='form-check-input' type='checkbox' name='size[]' value='$i' id='check$i'>
                                        <label class='form-check-label' for='check$i'>
                                            $i
                                        </label>
                                    </div>
                                ";
                                
                            }

                            // Размеры Римские
                            foreach ($sizes as $index => $value) {
                                echo "
                                    <div class='form-check'>
                                        <input class='form-check-input' type='checkbox' name='size[]' value='$value' id='check$value'>
                                        <label class='form-check-label' for='check$value'>
                                            $value
                                        </label>
                                    </div>
                                ";
                            }

                        ?>

                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Записать новые данные</button>
                </form>
                
            </div>
            
        </div>
        
    </div>

    

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/modules/footer.php');
?>