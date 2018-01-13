<?php
// Configuration de la  base de données
$DB_STRING = "mysql:host=localhost;dbname=tlo;charset=utf8";
$DB_LOGIN = "root";
$DB_PASSWORD = "";

//Configuration des utilisateurs : qui a accès à quel menu, et les mots de passe.
$STANDARD_MENU = 'STANDARD';
$ADN_MENU = 'ADN';

$USERS = array('user1' => 'password1', 'user2' => 'password2', 'user3' => 'password3', 'user4' => 'password4');
$USER_MENU = array('user1' => $STANDARD_MENU, 'user2' => $ADN_MENU, 'user3' => $STANDARD_MENU, 'user4' => $STANDARD_MENU);
?>