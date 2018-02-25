<?php 
require_once 'header.php'; 
require_once '../controllers/check_login.php';
require_once '../db.php';
try {
    $query = $db->prepare("select * from patients where rfid = ?");
    $query->execute(array($_SESSION['patient_rfid']));
    //Pas de while car on attend un résultat unique
    $resultat = $query->fetch(PDO::FETCH_OBJ);
    if($resultat){
        echo $resultat->nom;
    }else{
        echo "Patient non reconnu";
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo build_response(array('nom_patient' => ''), $AJAX_ERROR, '$e->getMessage()');
}
