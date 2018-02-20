<?php
require_once 'header.php';

session_start();
$helper = array_keys($_SESSION);
foreach ($helper as $key) {
    unset($_SESSION[$key]);
}
session_destroy();

$user_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
$erreur = filter_input(INPUT_GET, 'erreur', FILTER_SANITIZE_URL);
?>  
<div class="login_main">
    <span class="login_welcome">Bienvenue utilisateur <?php echo $user_id ?></span>
    <?php if (!$erreur) { ?>
        <span class="login_password_please">Veuillez saisir votre mot de passe</span>
    <?php } else { ?>
        <span class="login_password_erreur">Erreur d'authentification</span>
    <?php } ?>
    <form class="login_form" action="/controllers/do_login.php" method="post">
        <input class="login_password" id="password" type="password" name="password" autofocus /><br/>
        <input class="login_button" type="submit" value=""/>
        <input type ="hidden" name="user_id" value="<?php echo $user_id ?>"/>
    </form>
</div>
<?php require_once 'footer.php'; ?>