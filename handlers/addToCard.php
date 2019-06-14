<?php

    session_start();

    $data_id = $_GET['id'];

    // Если не существует $_SESSION['count'] то создаем его и присваиваем 0
    if (!isset($_SESSION['count'])) {
        $_SESSION['count'] = 0;
    }

    // Если  не существует массив айтемс то создаем его пустой 
    if (!isset($_SESSION['items'])) $_SESSION['items'] = [];   // можно записывать так при одном действии
    
    
    $_SESSION['count']++;
   
    // $_SESSION['count']++;

    $item_info = [
        'id' => $data_id,
        'count' => 1
    ];

    $goal = false;

    foreach($_SESSION['items'] as $ind => $val) {
        if ( $val['id'] == $data_id ) {
            $val['count']++;
            $_SESSION['items'][$ind]['count']++;
            $goal = true;
            break;
        }
    }

    if ($goal == false) array_push($_SESSION['items'], $item_info);
    
    

    

    // echo '<pre>';
    // print_r($_SESSION);
    // echo '</pre>';

    // session_destroy();

    echo json_encode($_SESSION['count']. ' Последний добавленный: ' . $data_id);

?>