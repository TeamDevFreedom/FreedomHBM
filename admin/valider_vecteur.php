<?php
require_once 'auth.php';
require_once '../db.php';
require_once '../ajax/ajax_utils.php';

$id_vecteur = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_URL);
$desc_vecteur_ok = html_entity_decode(filter_input(INPUT_POST, 'description_ok', FILTER_UNSAFE_RAW));
$desc_vecteur_nok = html_entity_decode(filter_input(INPUT_POST, 'description_nok', FILTER_UNSAFE_RAW));
try {
    $query = $db->prepare("update vecteur set statut='VALIDE', description_ok=?, description_nok=? where id = ?");
    $resultat = $query->execute(array($desc_vecteur_ok, $desc_vecteur_nok, $id_vecteur));
    if ($resultat) {
        echo build_response(array(), $AJAX_SUCCESS, '');
    } else {
        echo build_response(array(), $AJAX_FAILURE, 'Erreur de création du vecteur : '.$query->errorInfo()[2]);
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo build_response(array(), $AJAX_ERROR, $e->getMessage());
}
