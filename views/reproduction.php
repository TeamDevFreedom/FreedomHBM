<?php 
require_once 'header.php'; 
require_once '../controllers/check_login.php';
?>
<script>
    var redirectHandler = function (url) {
            window.location.href = url;
    };

    var documentReadyHandler = function () {
        $('#spermogramme').click(function () {
            navigateAnimation('resultats_reproduction.php?type=spermogramme', ANIM_CODE_SPERMOGRAMME);
        });
        $('#test_grossesse').click(function () {
            navigateAnimation('resultats_reproduction.php?type=test_grossesse.php', ANIM_CODE_TEST_GROSSESSE);
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
        <div class="reproduction_content">
            <img src="/img/picto_spermogramme.png" alt="Spermogramme" id="spermogramme"/>
            <img src="/img/picto_test_grossesse.png" alt="Test de grossesse" id="test_grossesse"/>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php require_once 'footer.php';
