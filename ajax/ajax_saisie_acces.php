<?php

require_once '../controllers/check_login.php';
$rfid_saisie = filter_input(INPUT_POST, 'rfid', FILTER_SANITIZE_URL);
try {
    $db = new PDO("mysql:host=localhost;dbname=tlo;charset=utf8", "root", "");
    $query = $db->prepare("select * from patients where rfid = ?");
    $query->execute(array($rfid_saisie));
    //Pas de while car on attend un résultat unique
    $resultat = $query->fetch(PDO::FETCH_OBJ);
    if($resultat){
        echo json_encode(array('nom_patient' => $resultat->nom));
        $_SESSION['patient_rfid'] = $rfid_saisie;
        //On marque le patient comme ayant été connecté au moins une fois
        $query_mark = $db->prepare("update patients p set p.a_utilise_hbm = 1 where p.rfid = ?");
        $query_mark->execute(array($rfid_saisie));
    }else{
        echo "";
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo "Error: " . $e;
}
