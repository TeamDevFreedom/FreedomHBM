<?php require_once 'header.php'; ?>
<script>
    var redirectHandler = function (url) {
            window.location.href = url;
    };

    var documentReadyHandler = function () {
        $('#desinfection').click(function () {
            redirectHandler('chir_desinfection.php');
        });
        $('#prelevement_tissus').click(function () {
            redirectHandler('chir_prelevement_tissus.php');
        });
        $('#intructions_chirurgie').click(function () {
            redirectHandler('chir_instructions.php');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<ul>
    <li id="desinfection">Désinfection</li>
    <li id="prelevement_tissus">Prélèvement de tissus</li>
    <li id="intructions_chirurgie">Instructions chirurgie</li>
</ul>
<?php require_once 'footer.php'; ?>
