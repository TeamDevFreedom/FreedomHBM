<?php

require_once '../controllers/check_login.php';
require_once 'ajax_utils.php';
require_once '../db.php';

$id_vecteur = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_URL);
try {
    $query = $db->prepare("update vecteur set statut='ADMINISTRE' where id = ?");
    $resultat = $query->execute(array($id_vecteur));
    if ($resultat) {
        echo build_response(array(), $AJAX_SUCCESS, '');
    } else {
        echo build_response(array(), $AJAX_FAILURE, 'Erreur de création du vecteur : '.$query->errorInfo()[2]);
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo build_response(array(), $AJAX_ERROR, '$e->getMessage()');
}
