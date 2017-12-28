<?php
require_once '../controllers/check_login.php';
require_once 'ajax_utils.php';
require_once '../db.php';

$rfid_saisie = filter_input(INPUT_POST, 'rfid', FILTER_SANITIZE_URL);
try {
    $query = $db->prepare("select base_1, base_2, base_3, base_4 from adn where rfid = ?");
    $query->execute(array($rfid_saisie));
    //Pas de while car on attend un résultat unique
    $resultat = $query->fetch(PDO::FETCH_OBJ);
    if($resultat){
        echo build_response(array('base1' => $resultat->base_1, 'base2' => $resultat->base_2, 'base3' => $resultat->base_3, 'base4' => $resultat->base_4), $AJAX_SUCCESS, '');
    }else{
        echo build_response(array('base1' => '', 'base2' => '', 'base3' => '', 'base4' => ''), $AJAX_FAILURE, 'Patient non reconnu');
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo build_response(array('base1' => '', 'base2' => '', 'base3' => '', 'base4' => ''), $AJAX_ERROR, '$e->getMessage()');
}
