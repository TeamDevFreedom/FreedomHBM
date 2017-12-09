<?php 
require_once 'header.php'; 
require_once '../controllers/check_login.php';
?>
<script>
    var redirectHandler = function (url) {
            window.location.href = url;
    };

    var documentReadyHandler = function () {
        $('#drogue').click(function () {
            redirectHandler('diag_drogue.php');
        });
        $('#maladie').click(function () {
            redirectHandler('diag_maladie.php');
        });
        $('#imagerie').click(function () {
            redirectHandler('diag_imagerie.php');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<ul>
    <li id="drogue">Rechercher drogue</li>
    <li id="maladie">Rechercher maladie</li>
    <li id="imagerie">Radio / Scanner</li>
</ul>
<?php require_once 'footer.php'; ?>
