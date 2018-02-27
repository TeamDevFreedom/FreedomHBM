<?php

// Configuration de la  base de données
$DB_STRING = "mysql:host=localhost;dbname=tlo;charset=utf8";
$DB_LOGIN = "root";
$DB_PASSWORD = "";

//Configuration des utilisateurs : qui a accès à quel menu, et les mots de passe.
$STANDARD_MENU = 'STANDARD';
$ADN_MENU = 'ADN';

//Ne pas mettre plus de 4 users. Ni moins. Penser à mettre dans /img/user_portraits les portraits des joueurs, nommés user1.jpg, user2.jpg, ...
$USERS = array('user1' => 'password1', 'user2' => 'password2', 'user3' => 'password3', 'user4' => 'password4');
$USER_MENU = array('user1' => $STANDARD_MENU, 'user2' => $ADN_MENU, 'user3' => $STANDARD_MENU, 'user4' => $STANDARD_MENU);
?>