<?php require_once 'header.php'; ?>
<script>
    var redirectHandler = function (url) {
            window.location.href = url;
    };

    var documentReadyHandler = function () {
        $('#spermogramme').click(function () {
            alert("Lancement de l'animation spermogramme puis redirection vers page de résultat");
        });
         $('#test_grossesse').click(function () {
            alert("Lancement de l'animation test de grossesse puis redirection vers page de résultat");
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<ul>
    <li id="spermogramme">Spermogramme</li>
    <li id="test_grossesse">Test de grossesse</li>
</ul>
<?php require_once 'footer.php'; ?>
