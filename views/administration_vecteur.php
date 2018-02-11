<?php

require_once 'header.php';
require_once '../controllers/check_login.php';
require_once '../db.php';

$patient_id = $_SESSION['patient_rfid'];
//On vérifie qu'il existe un vecteur validé pour le patient courant
try {
    $query = $db->prepare("select * from vecteur where rfid = ?");
    $query->execute(array($patient_id));
    if (empty($query->rowCount())) {
        echo "Il n'existe aucun vecteur pour cet utilisateur";
        return;
    }
    while ($ligne = $query->fetch(PDO::FETCH_OBJ)) {
        echo "Description du vecteur : " . $ligne->description." ";
        if($ligne->statut == "ADMINISTRE"){
            echo "Administré";
        }else if($ligne->statut == "CREE"){
            echo "En cours de création";
        }else{
            echo "<input type = 'submit' value = 'Administrer le vecteur' />";
        }
        echo "<br/>";
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>