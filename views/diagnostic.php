<?php 
require_once 'header.php'; 
require_once '../controllers/check_login.php';
?>
<script>
    var documentReadyHandler = function () {
        $('#drogue').click(function () {
            navigateAnimation('diag_resultat.php?type_diagnostic=drogue', ANIM_CODE_DIAGNOSTIC_DROGUE);
        });
        $('#maladie').click(function () {
            navigateAnimation('diag_resultat.php?type_diagnostic=maladie', ANIM_CODE_DIAGNOSTIC_MALADIE);
        });
        $('#imagerie').click(function () {
            navigateAnimation('diag_resultat.php?type_diagnostic=imagerie', ANIM_CODE_DIAGNOSTIC_IMAGERIE);
        });
         $('#bouton_retour').click(function () {
            navigateAnimation('menu_standard.php');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<div class="standard_page_body">
    <?php require_once './fragments/nom_patient_courant.php'; ?>
    <div class="standard_page_content">
        <div class="diagnostic_content">
            <img src="/img/picto_drogue.png" alt="Recherche de drogue" id="drogue"/>
            <img src="/img/picto_maladies.png" alt="Recherche de maladie" id="maladie"/>
            <img src="/img/picto_imagerie.png" alt="Imagerie médicale" id="imagerie"/>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php require_once 'footer.php'; ?>
