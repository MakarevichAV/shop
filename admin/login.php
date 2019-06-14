<?php
    $title = 'Вход';
    include($_SERVER['DOCUMENT_ROOT'].'/php/connect.php');
    include($_SERVER['DOCUMENT_ROOT'].'/modules/menuSql.php');
    include($_SERVER['DOCUMENT_ROOT'].'/modules/head.php');
?>


<form method="POST" action="/handlers/login.php">
    <input class="inp" type="text" name="login" placeholder="Ваш логин">
    <input class="inp" type="password" name="pass" placeholder="Ваш пароль">
    <input class="inp" type="submit" value="Войти">
</form>


<?php
    include($_SERVER['DOCUMENT_ROOT'].'/modules/footer.php');
?>