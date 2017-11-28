<?php require_once 'header.php'; ?>
<script>
    var redirectHandler = function (url) {
            window.location.href = url;
    };

    var documentReadyHandler = function () {
        $('#anesthesie').click(function () {
            alert("Lancement de l'animation anesthesie");
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<ul>
    <li id="anesthesie">Anesthesier</li>
</ul>
<?php require_once 'footer.php'; ?>
