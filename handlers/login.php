<?php
    $title = 'Вход';
    include($_SERVER['DOCUMENT_ROOT'].'/php/connect.php');
    include($_SERVER['DOCUMENT_ROOT'].'/modules/menuSql.php');
    include($_SERVER['DOCUMENT_ROOT'].'/modules/head.php');

    session_destroy(); 

    $login = 'admin';
    $password = '1f32aa4c9a1d2ea010adcf2348166a04'; // = 12345    // Зашифрованный
    $userPass = md5(md5($_POST['pass']));   // шифруем введенный пароль

    echo md5(md5('12345'));

    $error = '';

    // Проверяем отправку данных через ПОСТ
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST) ) {

        // Сравниваем логин и пароль
        if ( $login == $_POST['login'] && $password == $userPass ) {

            session_start();
            $_SESSION['user'] = 'admin';

        } else {
            $error = 'Не верный логин или пароль';
        }

    } else {
        $error = 'ИДИ ВОН!';
    }

    
?>

<?php if ( isset($_SESSION['user']) ): ?>  
    <?php if ( $_SESSION['user'] == 'admin' ): ?> 
        <!-- Инфа для админа -->
        <h1>Привет, Админ!</h1>
<?php endif; ?>
<?php else: ?>
    <?=$error?>
<?php endif; ?>


<?php
    include($_SERVER['DOCUMENT_ROOT'].'/modules/footer.php');
?>