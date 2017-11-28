<?php require_once 'header.php'; ?>
<script>
    var redirectHandler = function (url) {
            window.location.href = url;
    };

    var documentReadyHandler = function () {
        $('#calme').click(function () {
            redirectHandler('check_up2.php?etat=calme');
        });
        $('#agite').click(function () {
            redirectHandler('check_up2.php?etat=agite');
        });
        $('#tres_agite').click(function () {
            redirectHandler('check_up2.php?etat=tres_agite');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<ul>
    <li id="calme">Sujet calme</li>
    <li id="agite">Sujet agité</li>
    <li id="tres_agite">Sujet très agité</li>
</ul>
<?php require_once 'footer.php'; ?>
