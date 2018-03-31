<?php
require_once 'auth.php';
require_once '../db.php';
require_once '../ajax/ajax_utils.php';

$id_vecteur = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_URL);
$desc_vecteur = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_URL);
try {
    $query = $db->prepare("update vecteur set statut='VALIDE', description= ? where id = ?");
    $resultat = $query->execute(array($desc_vecteur, $id_vecteur));
    if ($resultat) {
        echo build_response(array(), $AJAX_SUCCESS, '');
    } else {
        echo build_response(array(), $AJAX_FAILURE, 'Erreur de création du vecteur : '.$query->errorInfo()[2]);
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo build_response(array(), $AJAX_ERROR, $e->getMessage());
}
