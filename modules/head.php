<?php
    session_start();
    if ( isset($_SESSION['count']) ) {
        $numberProd = $_SESSION['count'];
    } else {
        $numberProd = 0;
    }


?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/style.css">
    <?php  // Подключение стилей бутстрапа при условии, что существует переменная, в которую они записаны
        if ( isset($link_bootstrap) ) {
            echo $link_bootstrap;
        }
    ?>
    <title><?=$title?></title>
</head>
<body>
    <div class="wrapper padding30">
        <div class="header">
            <div class="menu">
                <a href="/" class="logo margin-right"></a>
                <div class="menu-button">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <div class="nav">
                    <?php foreach ($template['cats_parent'] as $key => $val): ?>
                        <a href="/pages/catalog.php?id=<?=$val['id']?>" class="item"><?=$val['name']?></a>
                    <?php endforeach; ?>
                    <!-- <a href="#" class="item">Женщинам</a>
                    <a href="#" class="item">Мужчинам</a>
                    <a href="#" class="item">Детям</a> -->
                    <a href="/pages/new.php" class="item">Новинки</a>
                    <a href="#" class="item">О нас</a>
                </div>
            </div>
            <div class="account">
                <div class="user">
                    <div class="account-icon"></div>
                    <p class="hello">Привет, <span class="user-name">Шурик</span> (<span class="exit">выйти</span>)</p>
                </div>
                <a href="#" class="basket">
                    Корзина(<span class="number"><?=$numberProd?></span>)
                </a>
            </div>
        </div>