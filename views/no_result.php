<?php

require_once 'header.php';
require_once '../controllers/check_login.php';
$url = filter_input(INPUT_GET, 'source_url', FILTER_SANITIZE_URL);
?>
<script>
    var documentReadyHandler = function () {
        $('#bouton_retour').click(function () {
            navigate('<?php echo $url?>');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<div class="standard_page_body">
    <?php require_once './fragments/nom_patient_courant.php'; ?>
    <div class="standard_page_content">
        <div class="no_result_content">
            <div class="no_result_txt">
            L'opération s'est déroulée avec succès
            </div>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php require_once 'footer.php'; ?>
