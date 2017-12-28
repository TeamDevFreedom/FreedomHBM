<?php 
require_once 'header.php'; 
require_once '../controllers/check_login.php';
?>
<script>
    var redirectHandler = function (url) {
            window.location.href = url;
    };

    var documentReadyHandler = function () {
        $('#prelever').click(function () {
            window.location.href = "prelevement_adn_resultat.php";
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<ul>
    <li id="prelever">Prélever</li>
</ul>
<?php require_once 'footer.php'; ?>
