<?php

require_once 'header.php';
require_once '../controllers/check_login.php';
require_once '../db.php';

$patient_id = $_SESSION['patient_rfid'];
$type_diag = filter_input(INPUT_GET, 'type_diagnostic', FILTER_SANITIZE_URL);
try {
    $query = $db->prepare("select * from patients where rfid = ?");
    $query->execute(array($patient_id));
    //Pas de while car on attend un résultat unique
    $resultat = $query->fetch(PDO::FETCH_OBJ);
    if ($resultat) {
        switch ($type_diag) {
            case "drogue" :
            default :
                $diagnostic = $resultat->diagnostic_drogue;
                break;
            case "imagerie" :
                $diagnostic = $resultat->diagnostic_imagerie;
                break;
            case "maladie" :
                $diagnostic = $resultat->diagnostic_maladie;
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
?>
<script>
    var redirectHandler = function (url) {
            window.location.href = url;
    };

    var documentReadyHandler = function () {
         $('#bouton_retour').click(function () {
            redirectHandler('diagnostic.php');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<div class="standard_page_body">
    <?php require_once './fragments/nom_patient_courant.php'; ?>
    <div class="standard_page_content">
        <div class="diagnostic_result">
            <div class="diagnostic_text"><?php echo $diagnostic;?></div>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>

<!--//FIXME ; jouer en fonction du diagnostic
echo "<script>play_anim(ANIM_CODE_DIAGNOSTIC_DROGUE)</script>";-->
<?php require_once 'footer.php';
