<?php

require_once 'header.php';
require_once '../controllers/check_login.php';
?>
<script>
    var documentReadyHandler = function () {
        $('#desinfection').click(function () {
            navigateAnimationNoResult(ANIM_CODE_CHIR_DESINFECTION);
        });
        $('#prelevement_tissus').click(function () {
            navigateAnimationNoResult(ANIM_CODE_CHIR_PRELEVEMENTS);
        });
        $('#intructions_chirurgie').click(function () {
            navigate('chir_instructions.php');
        });
        $('#bouton_retour').click(function () {
            navigate('menu_standard.php');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<div class="standard_page_body">
    <?php require_once './fragments/nom_patient_courant.php'; ?>
    <div class="standard_page_content">
        <div class="chirurgie_content">
            <img src="/img/picto_desinfection.png" alt="Désinfection" id="desinfection"/>
            <img src="/img/picto_prevelement.png" alt="Prélèvement de tissus" id="prelevement_tissus"/>
            <img src="/img/picto_instructions.png" alt="Instructions chirurgie" id="intructions_chirurgie"/>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php require_once 'footer.php'; ?>
