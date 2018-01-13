<?php 
require_once 'header.php'; 
require_once '../controllers/check_login.php';
?>
<script>
    var redirectHandler = function (url) {
            window.location.href = url;
    };

    var documentReadyHandler = function () {
        $('#antidouleurs').click(function () {
            play_anim(ANIM_CODE_SOINS_ANTIDOULEURS);
        });
        $('#antibiotiques').click(function () {
            play_anim(ANIM_CODE_SOINS_ANTIBIOTIQUES);
        });
        $('#inhalations').click(function () {
            play_anim(ANIM_CODE_SOINS_INHALATIONS);
        });
         $('#prise_sang').click(function () {
            play_anim(ANIM_CODE_SOINS_PRISE_SANG);
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<ul>
    <li id="antidouleurs">Injection d'antidouleurs</li>
    <li id="antibiotiques">Injection d'antibiotiques</li>
    <li id="inhalations">Inhalations</li>
    <li id="prise_sang">Prise de sang</li>
</ul>
<?php require_once 'footer.php'; ?>
