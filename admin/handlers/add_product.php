<?php

    include ($_SERVER['DOCUMENT_ROOT'].'/php/connect.php');


    // d($_FILES);  В массив $_FILES попадают загружаемые в форме файлы
    d($_POST);

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

        if ( !empty($_POST) ) {

            if ( !empty($_FILES['pic']['name']) ) {  // Если в массиве файлов есть файлы
                // То копируем файл из временного места в папку фоток для каталога и присваиваем уникальное имя файлу, используя вначале артикль
                copy( $_FILES['pic']['tmp_name'], '../../images/catalog/' . $_POST['article'] . '-' . $_FILES['pic']['name'] );

                //Записываем товар в БД в таблицу КАТАЛОГ
                $qr = "INSERT INTO `catalog` ( 
                                            `name`, 
                                            `price`, 
                                            `pic`, 
                                            `category_id`, 
                                            `article`, 
                                            `description`
                                            ) 
                                        VALUES (
                                            '{$_POST['product_name']}', 
                                            '{$_POST['product_price']}', 
                                            '{$_POST['article']}-{$_FILES['pic']['name']}', 
                                            '{$_POST['category']}', 
                                            '{$_POST['article']}', 
                                            '{$_POST['description']}'
                                            );";
                $result = mysqli_query($db, $qr);



                //Записываем размеры товара в таблицу размеров `sizes`
                foreach ($_POST['size'] as $i => $v) {
                    $qr_size = "INSERT INTO `sizes` ( 
                                                    `article`, 
                                                    `size`
                                                    ) 
                                                VALUES ( 
                                                    '{$_POST['article']}', 
                                                    '{$v}'
                                                    );";
                    $result_size = mysqli_query($db, $qr_size);
                }
                


                if ($result) {
                    echo 'Товар добавлен';
                } else {
                    echo 'Не удалось добавить товар, попробуйте еще раз';
                }

            } else {
                echo 'ERROR: Изображение не было добавлено';
            } 

        } else {
            echo 'Вернись и заполни все поля';   
        }

    } else {
        echo 'Вернись и заполни все поля';
    }

?>
