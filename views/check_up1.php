<?php
require_once 'header.php';
require_once '../controllers/check_login.php';
?>
<script>
    var documentReadyHandler = function () {
        $('#calme').click(function () {
            navigateAnimation('check_up2.php?etat=calme', ANIM_CODE_CHECK_UP);
        });
        $('#agite').click(function () {
            navigateAnimation('check_up2.php?etat=agite', ANIM_CODE_CHECK_UP_AGITE);
        });
        $('#tres_agite').click(function () {
            navigateAnimation('check_up2.php?etat=tres_agite', ANIM_CODE_CHECK_UP_TRES_AGITE);
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
        <div class="check_up_1_content">
            <img src="/img/picto_calme.png" alt="Sujet calme" id="calme"/>
            <img src="/img/picto_agite.png" alt="Sujet calme" id="agite"/>
            <img src="/img/picto_tres_agite.png" alt="Sujet calme" id="tres_agite"/>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php require_once 'footer.php'; ?>
