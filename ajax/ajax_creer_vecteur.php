<?php

require_once '../controllers/check_login.php';
require_once 'ajax_utils.php';
require_once '../db.php';

$vecteur_1 = filter_input(INPUT_POST, 'vecteur_1', FILTER_SANITIZE_URL);
$vecteur_2 = filter_input(INPUT_POST, 'vecteur_2', FILTER_SANITIZE_URL);
$vecteur_3 = filter_input(INPUT_POST, 'vecteur_3', FILTER_SANITIZE_URL);
$vecteur_4 = filter_input(INPUT_POST, 'vecteur_4', FILTER_SANITIZE_URL);
$patient_id = filter_input(INPUT_POST, 'patient_id', FILTER_SANITIZE_URL);

try {
    //Vérification de la validité du vecteur
    if (!preg_match("/[atgcATGC]{4}/", $vecteur_1 . $vecteur_2 . $vecteur_3 . $vecteur_4)) {
        echo build_response(array(), $AJAX_FAILURE, "Les 4 bases du vecteur doivent être saisies parmis les lettres A, T, G et C");
        return;
    }
    //D'abord on marque comme PERIME les vecteurs VALIDE.
    $query_perime = $db->prepare("update vecteur set statut = 'PERIME' where statut = 'VALIDE' ");
    $query_perime->execute(array());

    $query = $db->prepare("insert into vecteur(rfid, base_1, base_2, base_3, base_4, description_ok, description_nok, statut) values (?, ?, ?, ?, ?, ?, ?, ?)");
    $resultat = $query->execute(array($patient_id, strtoupper($vecteur_1), strtoupper($vecteur_2), strtoupper($vecteur_3), strtoupper($vecteur_4), '<Description à remplir par un orga>', '<Description à remplir par un orga>', 'CREE'));
    //Pas de while car on attend un résultat unique
    if ($resultat) {
        echo build_response(array(), $AJAX_SUCCESS, '');
    } else {
        echo build_response(array(), $AJAX_FAILURE, 'Erreur de création du vecteur : '.$query->errorInfo()[2]);
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo build_response(array('base1' => '', 'base2' => '', 'base3' => '', 'base4' => ''), $AJAX_ERROR, $e->getMessage());
}
