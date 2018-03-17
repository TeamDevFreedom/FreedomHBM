<?php
require_once 'header.php';
require_once '../controllers/check_login.php';
?>
<script>
    var documentReadyHandler = function () {
        $('#bouton_retour').click(function () {
            navigate('chir_instructions.php');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<div class="standard_page_body">
    <?php require_once './fragments/nom_patient_courant.php'; ?>
    <div class="standard_page_content">
        <div class="chir_instructions_detail_content">
            Praesent at nibh sit amet lectus eleifend bibendum ut vel turpis. Aliquam consectetur, nisi at tempor commodo, ex orci aliquet elit, eget condimentum elit felis a justo. Nulla dignissim tristique sollicitudin. Suspendisse potenti. Vivamus placerat, metus ac vehicula dapibus, justo sapien vehicula massa, ac ullamcorper nisi massa eget metus. Phasellus velit turpis, ornare ac mauris ut, sollicitudin interdum libero. Aenean imperdiet posuere ante, et interdum nulla fringilla et. Duis nec molestie odio, eget suscipit ex. Nulla finibus, nulla et condimentum suscipit, ante tortor vulputate urna, et mollis mauris urna sit amet tortor. Duis vulputate risus urna, id dapibus metus lobortis eget. Morbi at accumsan ante, consectetur sagittis urna. Duis aliquam sed orci nec facilisis. Sed id felis laoreet, semper nisi eget, ultrices risus. Donec ipsum turpis, tempus vitae euismod quis, tristique in risus.
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php require_once 'footer.php'; ?>