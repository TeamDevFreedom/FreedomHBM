<?php
require_once '../controllers/check_login.php';
require_once 'ajax_utils.php';
require_once '../db.php';

$rfid_saisie = filter_input(INPUT_POST, 'rfid', FILTER_SANITIZE_URL);
try {
    $query = $db->prepare("select * from patients where rfid = ?");
    $query->execute(array($rfid_saisie));
    //Pas de while car on attend un résultat unique
    $resultat = $query->fetch(PDO::FETCH_OBJ);
    if($resultat){
        echo build_response(array('nom_patient' => $resultat->nom), $AJAX_SUCCESS, '');
        $_SESSION['patient_rfid'] = $rfid_saisie;
        //On marque le patient comme ayant été connecté au moins une fois
        $query_mark = $db->prepare("update patients p set p.a_utilise_hbm = '1' where p.rfid = ?");
        $query_mark->execute(array($rfid_saisie));
    }else{
        echo build_response(array('nom_patient' => ''), $AJAX_FAILURE, 'Patient non reconnu');
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo build_response(array('nom_patient' => ''), $AJAX_ERROR, '$e->getMessage()');
}
