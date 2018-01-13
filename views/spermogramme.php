<?php

require_once 'header.php';
require_once '../controllers/check_login.php';
require_once '../db.php';

$patient_id = $_SESSION['patient_rfid'];

try {
    $query = $db->prepare("select * from patients where rfid = ?");
    $query->execute(array($patient_id));
    //Pas de while car on attend un résultat unique
    $resultat = $query->fetch(PDO::FETCH_OBJ);
    if ($resultat) {
        if($resultat->sexe == 'H'){
            $diagnostic = $resultat->spermogramme;
        }else{
            $diagnostic = 'Erreur : sexe incorrect';
        }
    } else {
        //Erreur : patient non trouvé : on redirige vers la page d'accueil
        header('Location: /views/home.php');
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}

echo "Résultat du spermogramme : " . $diagnostic . "<br/>";
echo "<script>play_anim(ANIM_CODE_SPERMOGRAMME)</script>";
require_once 'footer.php';