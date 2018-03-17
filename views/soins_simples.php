<?php
require_once 'header.php';
require_once '../controllers/check_login.php';
?>
<script>
    var documentReadyHandler = function () {
        $('#antidouleurs').click(function () {
            navigateAnimationNoResult(ANIM_CODE_SOINS_ANTIDOULEURS);
        });
        $('#antibiotiques').click(function () {
            navigateAnimationNoResult(ANIM_CODE_SOINS_ANTIBIOTIQUES);
        });
        $('#inhalations').click(function () {
            navigateAnimationNoResult(ANIM_CODE_SOINS_INHALATIONS);
        });
        $('#prise_sang').click(function () {
            navigateAnimationNoResult(ANIM_CODE_SOINS_PRISE_SANG);
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
        <div class="soins_simples_content">
            <div class="soins_simples_ligne">
                <img src="/img/picto_antidouleur.png" id="antidouleurs" alt="Injection d'antidouleurs"/>
                <img src="/img/picto_antibiotique.png" id="antibiotiques" alt="Injection d'antibiotiques"/>
            </div>
            <div class="soins_simples_ligne">
                <img src="/img/picto_inhalations.png" id="inhalations" alt="Inhalations"/>
                <img src="/img/picto_prise_sang.png" id="prise_sang" alt="Prise de sang"/>
            </div>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<ul>


</ul>
<?php require_once 'footer.php'; ?>
