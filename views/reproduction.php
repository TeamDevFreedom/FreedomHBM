<?php 
require_once 'header.php'; 
require_once '../controllers/check_login.php';
?>
<script>
    var redirectHandler = function (url) {
            window.location.href = url;
    };

    var documentReadyHandler = function () {
        $('#spermogramme').click(function () {
            redirectHandler('spermogramme.php');
        });
        $('#test_grossesse').click(function () {
            redirectHandler('test_grossesse.php');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<ul>
    <li id="spermogramme">Spermogramme</li>
    <li id="test_grossesse">Test de grossesse</li>
</ul>
<?php require_once 'footer.php';
