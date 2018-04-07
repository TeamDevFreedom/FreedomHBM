<?php
require_once 'header.php';
require_once '../controllers/check_login.php';
require_once '../db.php';

$id_vecteur = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
$patient_id = $_SESSION['patient_rfid'];
try {
    $query_update = $db->prepare("update vecteur set statut='ADMINISTRE' where id = ?");
    $query_update->execute(array($id_vecteur));
    $query_update->closeCursor();
    
    $query_check = $db->prepare("select * from vecteur where id = ?");
    $query_check->execute(array($id_vecteur));
    $vecteur = $query_check->fetch(PDO::FETCH_OBJ);
    
    $description = "";
    if($vecteur->rfid  != $patient_id){
        $description = $vecteur->description_nok;
    }else{
        $description = $vecteur->description_ok;
    }
} catch (PDOException $e) {
    echo build_response(array(), $AJAX_ERROR, '$e->getMessage()');
}
?>
<script>
    var documentReadyHandler = function () {
        $('#bouton_retour').click(function () {
            navigate('administration_vecteur.php');
        });
    };
    $(document).ready(documentReadyHandler);

</script>
<div class="standard_page_body">
    <?php require_once './fragments/nom_patient_courant.php'; ?>
    <div class="standard_page_content">
        <div class="admin_vecteur_resultat_content">
            <div class="admin_vecteur_resultat_text">
                <?php echo $description;?>
            </div>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php require_once 'footer.php'; ?>