<?php
    include($_SERVER['DOCUMENT_ROOT'].'/php/connect.php');

    // Пункты меню из базы данных
    include($_SERVER['DOCUMENT_ROOT'].'/modules/menuSql.php');

    // Берем из массива ГЕТ id переданного товара (на который кликнули)
    $productId = $_GET['id'];

    // Ищем товар с переданным ID в БД
    $qrProduct = "SELECT * FROM `catalog` WHERE `id` = $productId";
    $resProduct = mysqli_query($db, $qrProduct);
    $rowProduct = mysqli_fetch_assoc($resProduct);

    // Подставляем название товара в title
    $title = $rowProduct['name'];

    // Берем id подкатегории 
    $subcat = $rowProduct['category_id'];

    // Ищем название подкатегории 
    $subCatID = "SELECT * FROM `categories` WHERE `id` = $subcat";
    $resCatID = mysqli_query($db, $subCatID);
    $rowCatID = mysqli_fetch_assoc($resCatID);

    // Берем id родительской категории 
    $parentID = $rowCatID['parent_category'];
    
    // Ищем родительскую категорию
    $parentCat = "SELECT * FROM `categories` WHERE `id` = $parentID";
    $resParent = mysqli_query($db, $parentCat);
    $rowParent = mysqli_fetch_assoc($resParent);

    // Ищем все строчки с артикулом даннаго товара
    $articleSize = "SELECT * FROM `sizes` WHERE `article` = '{$rowProduct['article']}'";
    $resArticleSize = mysqli_query($db, $articleSize);
    while ( $rowSize = mysqli_fetch_assoc($resArticleSize) ) {
        $sizes[] = $rowSize;
    }
    

    // Подключение шапки сайта
    include($_SERVER['DOCUMENT_ROOT'].'/modules/head.php');
?>

<div class="bread-crumbs">
    <a href="/index.php" class="bread-crumbs-item">Главная</a> /
    <a href="/pages/catalog.php?id=<?=$rowCatID['parent_category']?>" class="bread-crumbs-item"><?=$rowParent['name']?></a> /
    <a href="/pages/catalog.php?id=<?=$rowCatID['id']?>" class="bread-crumbs-item"><?=$rowCatID['name']?></a> /
    <a href="#" class="bread-crumbs-item"><?=$rowProduct['name']?></a>
</div>

<div class="picture margin-bottom20" style="background-image: url(/images/catalog/<?=$rowProduct['pic']?>)"></div>
<h1 class="head1 margin-bottom10"><?=$rowProduct['name']?></h1>
<p class="article margin-bottom20">Артикул: <?=$rowProduct['article']?></p>
<p class="price margin-bottom20"><?=$rowProduct['price']?> руб.</p>
<p class="description margin-bottom20"><?=$rowProduct['description']?></p>
<p class="size margin-bottom10">РАЗМЕР</p>
<div class="size-range margin-bottom40">
    
    <!-- Вставляем все размеры товара из массива размеров -->
    <?php foreach ( $sizes as $index => $value ):?>
        <label>
            <input type="radio" name="size" value="<?=$value['size']?>" class="radio-none">
            <div class="size-value"><?=$value['size']?></div>   
        </label>
    <?php endforeach?>
    <!-- <div class="size-value">39</div>
    <div class="size-value">40</div>
    <div class="size-value">42</div>
    <div class="size-value">44</div> -->
</div>

<!-- кнопка для добавления товара в корзину  /  пока сделанная ссылкой -->
<a href="#" class="submit bg-orange txt-color-white margin-bottom80">Добавить в корзину</a>


<?php
    // echo '<pre>';
    // print_r($sizes);
    // echo '</pre>';
?>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/modules/footer.php');
?>
