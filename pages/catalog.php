<?php
    $title = 'Каталог';
    include($_SERVER['DOCUMENT_ROOT'].'/php/connect.php');

    // Пункты меню из базы данных
    include($_SERVER['DOCUMENT_ROOT'].'/modules/menuSql.php');

    // Берем количество полученных строк, в дальнейшем будем сравнивать с этим числом передаваемое число в ГЕТе (строка *)
    $num_cats_parent = mysqli_num_rows($cats_parent);
    // print_r($num_cats_parent);

    // пустая переменная, будем заносить в нее значение родительской категории
    $cat_id = '';

    // Если существует элемент массива id (т е если он был передан)
    if ( isset($_GET['id']) ) {
        // то проверяем его на пустоту
        // если непустой
        if ( !empty($_GET['id']) ) {

            // то проверяем чтобы число было не больше количества родительских категорий
            if ($_GET['id'] > $num_cats_parent) {   // если больше  // *
                // то присваиваем переменной значение по умолчанию 1 (отобразятся товары для мужчин)
                $cat_id = 1;
            } else {
                // иначе присваиваем значение передаваемого id переменной 
                $cat_id = $_GET['id'];
            }

        } else {
            // иначе присваиваем по умолчанию значение 1 передаваемого id переменной 
            $cat_id = 1;
        }

    } else {
        // иначе присваиваем по умолчанию значение 1 передаваемого id переменной 
        $cat_id = 1;
    }

    // Выбираем строку из таблицы категорий где родительская категория равна переданной в массив ГЕТ
    $qr_cats = "SELECT * FROM `categories` WHERE `parent_category` = $cat_id";
    $cats = mysqli_query($db, $qr_cats);
    while ( $row_cats = mysqli_fetch_assoc($cats) ) {
        $template['cats'][] = $row_cats;
    }

    // echo '<pre>';
    // print_r($template);
    // echo '</pre>';

    // Выбираем строку с родительской категорией товаров, в зависимости от того, какой id был передан в массиве $_GET
    $qr_cat_parent = "SELECT * FROM `categories` WHERE `id` = $cat_id";
    $result_parent = mysqli_query($db, $qr_cat_parent);
    $row_parent = mysqli_fetch_assoc($result_parent);

    // print_r($row_parent);
?>

        <?php
            include($_SERVER['DOCUMENT_ROOT'].'/modules/head.php');
        ?>
        <div class="bread-crumbs">
            <a href="/index.php" class="bread-crumbs-item">Главная</a> /
            <a href="/pages/catalog.php?id=<?=$row_parent['id']?>" class="bread-crumbs-item"><?=$row_parent['name']?></a>
        </div>
        <div class="content" id="catalog">
            <h1 class="head1"><?=$row_parent['name']?></h1>
            <p class="subhead">Все товары</p>
        </div>
        <div class="filter">
            <div class="select">
                <p class="filter-item">Категория <span class="arrow">&#9660;</span></p>   <!--&#9650;-->
                <div class="select-item">

                    <?php foreach ($template['cats'] as $key => $val):?>
                        <label class="option">
                            <input type="radio" name="subcat" value="<?=$val['id']?>" class="subcat">
                            <?=$val['name']?>
                        </label>
                    <?php endforeach; ?>

                </div>
            </div>
            <div class="select">
                <p class="filter-item">Размер <span class="arrow">&#9660;</span></p>   <!--&#9650;-->
                <div class="select-item sizes">
                    <p class="option">XS</p>
                    <p class="option">S</p>
                    <p class="option">M</p>
                    <p class="option">L</p>
                    <p class="option">XL</p>
                    <p class="option">XXL</p>
                    <p class="option">XXXL</p>
                </div>
            </div>
            <div class="select">
                <p class="filter-item">Стоимость <span class="arrow">&#9660;</span></p>   <!--&#9650;-->
                <div class="select-item">
                    <p class="option"><span>0 - 1000</span> руб.</p>
                    <p class="option"><span>1000 - 3000</span> руб.</p>
                    <p class="option"><span>3000 - 6000</span> руб.</p>
                    <p class="option"><span>6000 - 20000</span> руб.</p>
                </div>
            </div>
        </div>
    
        <div class="goods">
            <!-- Сюда загружаются карточки товаров -->
        </div>
     
        <div class="content-nav padding-bottom-330">
            <!-- <div class="content-nav-item opened">1</div>
            <div class="content-nav-item">2</div>
            <div class="content-nav-item">3</div>
            <div class="content-nav-item">4</div> -->
        </div>
    
        <?php
            include($_SERVER['DOCUMENT_ROOT'].'/modules/footer.php');
        ?>