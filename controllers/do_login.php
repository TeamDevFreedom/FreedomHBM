<?php

require_once("../config.php");
session_start();

//FIXME : Faire un vrai login
$user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_URL);
$user_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_URL);

$expected_password = $USERS[$user_id];
if (isset($expected_password) && $expected_password === $user_password) {
    $_SESSION['user_id'] = $user_id;
    $user_menu = $USER_MENU[$user_id];
    if($user_menu == $STANDARD_MENU){
        header('Location: /views/menu_standard.php');
    }else if($user_menu == $ADN_MENU){
        header('Location: /views/menu_adn.php');
    }else{
        header('Location: /views/erreur_menu_non_param.php');
    }

} else {
    header('Location: /views/login.php?id='.$user_id);
}
exit();
