<?php
require_once 'header.php';
require_once '../controllers/check_login.php';

$return_url = filter_input(INPUT_GET, 'return_url', FILTER_SANITIZE_URL);
$wait = filter_input(INPUT_GET, 'wait', FILTER_SANITIZE_URL);
$code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_URL);
?>
<script>
    var code = "<?php echo $code; ?>";
    var wait = <?php echo $wait; ?>;
    var returnURL = "<?php echo $return_url; ?>";
    var documentReadyHandler = function () {
        $.post(ANIM_BASE_URL + code);
        setTimeout(function () {
            navigate(returnURL);
        }, wait);
    };
    $(document).ready(documentReadyHandler);
</script>
<div class ="loading_container">
    <div class="loading_text">Merci de bien vouloir patienter, opération en cours.</div>
    <div class="cssload-container">
        <div class="cssload-item cssload-ventilator"></div>
    </div>
</div>