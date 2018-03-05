<script>
    var documentReadyHandler = function () {
        $('#bouton_retour').click(function () {
            redirectHandler('menu_standard.php');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<div class="standard_page_footer">
    <img src="/img/bouton_retour.png" id="bouton_retour" alt="retour"/>
</div>
