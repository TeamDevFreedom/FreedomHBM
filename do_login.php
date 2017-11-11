<?php
session_start();

//FIXME : Faire un vrai login
$user_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_URL);
$user_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_URL);
$_SESSION['user_id'] = $user_id;
header('Location: ./menu.php');
exit();
