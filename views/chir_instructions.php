<?php 
require_once 'header.php'; 
require_once '../controllers/check_login.php';
?>
<script>
    var documentReadyHandler = function () {
        $('#balle').click(function () {
            navigate('chir_instructions_balle.php');
        });
        $('#fracture').click(function () {
            navigate('chir_instructions_fracture.php');
        });
        $('#plaie').click(function () {
            navigate('chir_instructions_plaie.php');
        });
        $('#tumeur').click(function () {
            navigate('chir_instructions_tumeur.php');
        });
        $('#lourde').click(function () {
            navigate('chir_instructions_lourde.php');
        });
        $('#bouton_retour').click(function () {
            navigate('prepa_chirurgie.php');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<div class="standard_page_body">
    <?php require_once './fragments/nom_patient_courant.php'; ?>
    <div class="standard_page_content">
        <div class="chir_instructions_content">
            <div class="chir_instructions_row_1">
                <img src="/img/picto_balle.png" alt="Blessure par balle" id="balle"/>
                <img src="/img/picto_fracture.png" alt="Réduction de fracture" id="fracture"/>
                <img src="/img/picto_plaie.png" alt="Soins plaie" id="plaie"/>
            </div>
            <div class="chir_instructions_row_2">
                <img src="/img/picto_tumeur.png" alt="Ablation de tumeur" id="tumeur"/>
                <img src="/img/picto_chir_lourde.png" alt="Chirurgie lourde" id="lourde"/>
            </div>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php require_once 'footer.php'; ?>