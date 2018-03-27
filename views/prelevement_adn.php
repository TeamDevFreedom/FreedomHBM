<?php 
require_once 'header.php'; 
require_once '../controllers/check_login.php';
?>
<script>
    var documentReadyHandler = function () {
        $('#prelever').click(function () {
            navigateAnimation('prelevement_adn_resultat', ANIM_CODE_PRELEVEMENT_ADN);
        });
        $('#bouton_retour').click(function () {
            navigate('menu_adn.php');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<div class="standard_page_body">
    <?php require_once './fragments/nom_patient_courant.php'; ?>
    <div class="standard_page_content">
        <div class="anesthesie_content">
            <img id="prelever" src="/img/icone_prelevevement_adn.png" alt="Prélèvement ADN"/>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php require_once 'footer.php'; ?>