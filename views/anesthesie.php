<?php 
require_once 'header.php'; 
require_once '../controllers/check_login.php';
?>
<script>
    var redirectHandler = function (url) {
            window.location.href = url;
    };

    var documentReadyHandler = function () {
        $('#anesthesie').click(function () {
            play_anim(ANIM_CODE_ANESTHESIE);
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<ul>
    <li id="anesthesie">Anesthesier</li>
</ul>
<?php require_once 'footer.php'; ?>
