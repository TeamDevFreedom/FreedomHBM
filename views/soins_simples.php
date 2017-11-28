<?php require_once 'header.php'; ?>
<script>
    var redirectHandler = function (url) {
            window.location.href = url;
    };

    var documentReadyHandler = function () {
        $('#antidouleurs').click(function () {
            alert("Lancement de l'animation injection antidouleur");
        });
        $('#antibiotiques').click(function () {
            alert("Lancement de l'animation injection antibiotiques");
        });
        $('#inhalations').click(function () {
            alert("Lancement de l'animation inhalations");
        });
         $('#prise_sang').click(function () {
            alert("Lancement de l'animation prise de sang");
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
