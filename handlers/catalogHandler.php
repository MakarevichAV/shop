<?php
    include ($_SERVER['DOCUMENT_ROOT'].'/php/connect.php');
    
    $cat = $_GET['id'];

    $currentPage = $_GET['page'];
    
    $itemsOnPage = 4;

    // sleep(1);  // имитация загрузки каталога

    // Массив товаров
    $goods_array = [
        'items' => [

        ],
        'pagination' => [
            'allPages' => 0,
            'currentPage' => $currentPage
        ],
        'sizes' => []

    ];

    $maxItems = $currentPage * $itemsOnPage;
    $minItems = $currentPage * $itemsOnPage - $itemsOnPage;

    // Ищем дочерние категории на основании переданной родительской категории
    $query = "SELECT * FROM `categories` WHERE `parent_category` = $cat";
    $result = mysqli_query($db, $query);

    // Если количество строк в результате не равно 0 (т е пришли родительские категории) 
    if ( mysqli_num_rows($result) !=0 ) {

        // нужно записать категории в виде (4,5,6,7)
        $allCatsID = []; // пустой массив для записи в него результата
        // перебираем результат
        while ( $row_parent = mysqli_fetch_assoc($result) ) {
            // идентификаторы каждой строчки помещаем в массив
            $allCatsID[] = $row_parent['id'];
        }
        // превращаем массив в строку
        $catsLine = implode(',', $allCatsID);

        // print_r($catsLine);
        // die();

        $qr = "SELECT * FROM `catalog` WHERE `category_id` IN ($catsLine)";
        $goods = mysqli_query($db, $qr);

        $countRows = mysqli_num_rows($goods);                     // количество строчек с товарами
        $countRows = ceil($countRows / $itemsOnPage);             // делим на колво отображаемых и округляем в большую 
        $goods_array['pagination']['allPages'] = $countRows;      // записываем в массив количество кубиков

        // Поиск только требуемых товаров
        $qr = "SELECT * FROM `catalog` WHERE `category_id` IN ($catsLine) LIMIT $minItems, $itemsOnPage";
        $goods = mysqli_query($db, $qr);
        

        //echo mysqli_num_rows($goods);  // кол-во строчек

        while ( $row = mysqli_fetch_assoc($goods) ) {
            array_push( $goods_array['items'], $row );
        }

        // $residue = count($goods_array['items']) % 4;   // остаток от деления кол-ва товаров на количество отображаемых товаров
        // $allPages = count($goods_array['items']) / 4;  // количество кубиков (кличество страниц по пять товаров без остатка)
        // if ( $residue = 0 ) {  // если остаток равен 0 
        //     $goods_array['pagination']['allPages'] = $allPages; // то записываем в массив количество кубиков
        // } else {               // а если не равно 0, т е остаток есть
        //     $goods_array['pagination']['allPages'] = $allPages + 1;  // то записываем в массив кол-во кубиков + 1
        // }
        
        // array_push( $goods_array['pagination']['allPages'], count($goods_array['items']) );
        

        // Конвертация для JS
        // JSON - JS Object Notation - Формат для отправки данных
        echo json_encode($goods_array);   // перевели в формат JSON

    } else {

        // ищем товары, соответствующие подкатегориям
        $query = "SELECT * FROM `catalog` WHERE `category_id` = $cat";
        $goods = mysqli_query($db, $query);

        while ( $row = mysqli_fetch_assoc($goods) ) {
            $goods_array['items'][] = $row;
        }
        foreach ( $goods_array['items'] as $key => $val ) {  // для каждого товара
            $qr = "SELECT `size` FROM `sizes` WHERE `article` = '{$val['article']}'"; // берем артиклул и выбираем все размеры этого товара из таблицы размеров
            $sizes = mysqli_query($db, $qr);
            // заносим все размеры в массив template['sizes']
            while ( $row = mysqli_fetch_assoc($sizes) ) {
                $goods_array['sizes'][] = $row['size'];
            }
        }
        // делаем массив $goods_array['sizes'] с уникальными значениями // чтобы не повторялись размеры
        $goods_array['sizes'] = array_unique($goods_array['sizes']);
        // и сортируем его по возрастанию
        sort($goods_array['sizes']);

        // теперь можно очистить массив $goods_array['items']
        $goods_array['items'] = [];
        // d($goods_array);

        $countRows = mysqli_num_rows($goods);                     // количество строчек с товарами
        $countRows = ceil($countRows / $itemsOnPage);             // делим на колво отображаемых и округляем в большую 
        $goods_array['pagination']['allPages'] = $countRows;      // записываем в массив количество кубиков

        // Поиск только требуемых товаров
        $qr = "SELECT * FROM `catalog` WHERE `category_id` = $cat LIMIT $minItems, $itemsOnPage";
        $goods = mysqli_query($db, $qr);

        while ( $row = mysqli_fetch_assoc($goods) ) {
            $goods_array['items'][] = $row;
        }

        // $residue = count($goods_array['items']) % 5;   // остаток от деления кол-ва товаров на количество отображаемых товаров
        // $allPages = count($goods_array['items']) / 5;  // количество кубиков (кличество страниц по пять товаров без остатка)
        // if ( $residue = 0 ) {  // если остаток равен 0 
        //     $goods_array['pagination']['allPages'] = $allPages; // то записываем в массив количество кубиков
        // } else {               // а если не равно 0, т е остаток есть
        //     $goods_array['pagination']['allPages'] = $allPages + 1;  // то записываем в массив кол-во кубиков + 1
        // }

        echo json_encode($goods_array);
    }

    


?>