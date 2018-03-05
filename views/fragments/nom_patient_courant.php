<?php
require_once 'header.php';
require_once '../controllers/check_login.php';
require_once '../db.php';
try {
    $query = $db->prepare("select * from patients where rfid = ?");
    $query->execute(array($_SESSION['patient_rfid']));
    //Pas de while car on attend un résultat unique
    $resultat = $query->fetch(PDO::FETCH_OBJ);
    if ($resultat) {
        $patient_nom = $resultat->nom;
    } else {
        $patient_nom = "Patient non reconnu";
    }
    $query->closeCursor();
} catch (PDOException $e) {
    $patient_nom = 'Erreur : ' . $e->getMessage();
}
?>
<div class="standard_page_header">
    <div class="nom_patient_puces">
        <img src="/img/puce.png" alt="puce"/>
        <span class="patient_nom"><?php
            echo 'Patient : ' . $patient_nom;
            ?></span>
        <img src="/img/puce.png" alt="puce"/>
    </div>
</div>