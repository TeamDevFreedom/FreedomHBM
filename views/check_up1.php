<?php
require_once 'header.php';
require_once '../controllers/check_login.php';
?>
<script>
    var redirectHandler = function (url) {
        window.location.href = url;
    };

    var documentReadyHandler = function () {
        $('#calme').click(function () {
            redirectHandler('check_up2.php?etat=calme');
        });
        $('#agite').click(function () {
            redirectHandler('check_up2.php?etat=agite');
        });
        $('#tres_agite').click(function () {
            redirectHandler('check_up2.php?etat=tres_agite');
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
