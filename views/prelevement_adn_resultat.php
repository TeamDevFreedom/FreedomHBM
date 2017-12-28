<?php

require_once 'header.php';
require_once '../controllers/check_login.php';
require_once '../db.php';

$patient_id = $_SESSION['patient_rfid'];

try {
    $query = $db->prepare("select * from adn where rfid = ?");
    $query->execute(array($patient_id));
    //Pas de while car on attend un résultat unique
    $resultat = $query->fetch(PDO::FETCH_OBJ);
    if ($resultat) {
        $base_1 = $resultat->base_1;
        $base_2 = $resultat->base_2;
        $base_3 = $resultat->base_3;
        $base_4 = $resultat->base_4;
        //Le séquençage ayant réussi, on l'indique comme effectué dans la BDD
        $query_mark = $db->prepare("update adn a set a.prelevement_effectue = 'T' where a.rfid = ?");
        $query_mark->execute(array($patient_id));
    } else {
        //Erreur : patient non trouvé : on redirige vers la page d'accueil
        header('Location: /views/home.php');
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}

echo "Résultat du séquencage ADN : " . $base_1." ".$base_2." ".$base_3." ".$base_4. "<br/>";

require_once 'footer.php';