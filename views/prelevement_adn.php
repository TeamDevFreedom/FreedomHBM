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
            alert("Lancement de l'animation prélèvement ADN, puis affichage des 4 lettres du résultat");
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<ul>
    <li id="prelever">Prélever</li>
</ul>
<?php require_once 'footer.php'; ?>
