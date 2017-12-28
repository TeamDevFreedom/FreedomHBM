<?php

require_once 'header.php';
require_once '../controllers/check_login.php';
require_once '../db.php';

function generer_systole($etat_patient) {
    switch ($etat_patient) {
        case 'calme':
        default :
            $min = 90;
            $max = 120;
            break;
        case 'agite':
            $min = 121;
            $max = 139;
            break;
        case 'tres_agite':
            $min = 140;
            $max = 179;
            break;
    }
    return rand($min, $max) / 10.0;
}

function generer_diastole($etat_patient) {
    switch ($etat_patient) {
        case 'calme':
        default :
            $min = 60;
            $max = 80;
            break;
        case 'agite':
            $min = 81;
            $max = 89;
            break;
        case 'tres_agite':
            $min = 90;
            $max = 109;
            break;
    }
    return rand($min, $max) / 10.0;
}

function generer_tension($etat_patient) {
    return generer_systole($etat_patient) . " / " . generer_diastole($etat_patient);
}

$patient_id = $_SESSION['patient_rfid'];
$etat_patient = filter_input(INPUT_GET, 'etat', FILTER_SANITIZE_URL);

try {
    $query = $db->prepare("select * from patients where rfid = ?");
    $query->execute(array($patient_id));
    //Pas de while car on attend un résultat unique
    $resultat = $query->fetch(PDO::FETCH_OBJ);
    if ($resultat) {
        switch ($etat_patient) {
            case 'calme':
            default :
                $infos_etat = $resultat->etat_patient_calme;
                break;
            case 'agite':
                $infos_etat = $resultat->etat_patient_agite;
                break;
            case 'tres_agite':
                $infos_etat = $resultat->etat_patient_agite;
                break;
        }
    } else {
        //Erreur : patient non trouvé : on redirige vers la page d'accueil
        header('Location: /views/home.php');
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}
$tension = generer_tension($etat_patient);

echo "Etat : " . $infos_etat . "<br/>";
echo "Tension : " . $tension . "<br/>";
echo "Groupe sanguin : " . $resultat->groupe_sanguin . "<br/>";
echo "Informations sanguines : " . $resultat->infos_sang . "<br/>";

require_once 'footer.php';
