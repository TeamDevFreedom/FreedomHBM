<?php

require_once 'header.php';
require_once '../controllers/check_login.php';
?>
<script>
    var redirectHandler = function (url) {
        window.location.href = url;
    };

    var documentReadyHandler = function () {
        $('#desinfection').click(function () {
            play_anim(ANIM_CODE_CHIR_DESINFECTION);
        });
        $('#prelevement_tissus').click(function () {
            play_anim(ANIM_CODE_CHIR_PRELEVEMENTS);
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
