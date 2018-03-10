<?php 
require_once 'header.php'; 
require_once '../controllers/check_login.php';
?>
<script>
    var documentReadyHandler = function () {
        $('#anesthesie').click(function () {
            navigateAnimation('anesthesie.php', ANIM_CODE_ANESTHESIE);
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
        <div class="anesthesie_content">
            <img src="/img/picto_anesthesie_2.png" alt="Anesthésier" id="anesthesie"/>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php require_once 'footer.php'; ?>
