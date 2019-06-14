<?php
    include($_SERVER['DOCUMENT_ROOT'].'/php/connect.php');

    // Пункты меню из базы данных
    include($_SERVER['DOCUMENT_ROOT'].'/modules/menuSql.php');

    // title 
    $title = 'Главная';
    // Подключение шапки сайта
    include($_SERVER['DOCUMENT_ROOT'].'/modules/head.php');
?>

<h1 class="head1 font-size-40 margin-bottom10 margin-top-80">Новые поступления весны</h1>
<p class="subhead weight-norm">Мы подготовили для Вас лучшие новинки сезона</p>
<a href="#" class="submit border-1px-gray txt-color-gray margin-bottom80">Посмотреть новинки</a>

<div class="grid margin-bottom150">
    <div id="block1" class="double-grid-elem">
        <div class="description">
            <p class="descript-text font-size22 uppercase">
                джинсовые куртки
                <br />
                <span class="descript-text font-size16 uppercase italic">
                    New Arrival
                </span>

            </p>
        </div>
    </div>
    <div id="block2" class="grid-elem">
        <div class="description">
            <div class="important margin-bottom16"></div>
            <p class="descript-text italic">
                каждый сезон мы подготавливаем для 
                Вас исключительно лучшую модну одежду. 
                Следит за нашими новинками
            </p>
        </div>
    </div>
    <div id="block3" class="grid-elem"></div>
    <div id="block4" class="grid-elem">
        <div class="description">
            <div class="arrow margin-bottom16"></div>
            <p class="descript-text font-size22 uppercase">
                Элегантная обувь
                <br />
                <span class="descript-text font-size16 uppercase italic">
                    ботинки, кросовки
                </span>
            </p>
        </div>
    </div>
    <div id="block5" class="grid-elem">
        <div class="description">
            <p class="descript-text font-size22 uppercase">
                джинсы
                <br/>
                <span class="descript-text font-size16 italic">
                    от 3200 руб.
                </span>

            </p> 
        </div>
    </div>
    <div id="block6" class="grid-elem">
        <div class="description">
            <div class="important margin-bottom16"></div>
            <p class="descript-text italic">
                Самые низкие цены в Москве.
                Нашли дешевле? Вернем разницу.
            </p>
        </div>
    </div>
    <div id="block7" class="double-grid-elem">
        <div class="description">
            <p class="descript-text font-size22 uppercase">
                детская одежда
                <br />
                <span class="descript-text font-size16 uppercase italic">
                    New Arrival
                </span>
            </p>
        </div>
    </div>
    <div id="block8" class="grid-elem"></div>
    <div id="block9" class="grid-elem">
        <div class="description">
            <div class="arrow margin-bottom16"></div>
            <p class="descript-text font-size22 uppercase">
                Аксессуары
            </p>
        </div>
    </div>
    <div id="block10" class="grid-elem">
        <div class="blackout flex-center">
            <div class="description">
                <p class="descript-text font-size22 uppercase">
                    Спортивная одежда
                    <br/>
                    <span class="descript-text font-size16 italic">
                        от 590 руб.
                    </span>

                </p> 
            </div>
        </div>
    </div>
</div>

<h2 class="head2 margin-bottom10">будь всегда в курсе выгодных предложений</h2>
<p class="subhead margin-bottom40 weight-norm">подписывайся и следи за новинками и выгодными предложениями.</p>
<form class="email margin-bottom90" action="#" method="POST">
    <input type="text" name="email" placeholder="e-mail">
    <input type="submit" value="Подписаться">
</form>

<?php
    // echo '<pre>';
    // print_r($sizes);
    // echo '</pre>';
?>

<?php
    include($_SERVER['DOCUMENT_ROOT'].'/modules/footer.php');
?>
