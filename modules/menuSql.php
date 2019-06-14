<?php
    // Пункты меню из базы данных
    $qr_parent = "SELECT * FROM `categories` WHERE `parent_category` = 0";
    $cats_parent = mysqli_query($db, $qr_parent);
    $template = [];
    while ( $row_cats_parent = mysqli_fetch_assoc($cats_parent) ) {
        $template['cats_parent'][] = $row_cats_parent;
    }
?>