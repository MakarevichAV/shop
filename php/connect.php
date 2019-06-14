<?php
    $db = mysqli_connect('localhost', 'root', '', 'makarevich_15122018');
    mysqli_set_charset($db, 'utf8');

    function d($array) {
        echo '<pre>';
        print_r($array);
        echo '<pre>';
    }

?>