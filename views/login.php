<?php require_once 'header.php';

session_start();
$helper = array_keys($_SESSION);
foreach ($helper as $key) {
    unset($_SESSION[$key]);
}
session_destroy();

$user_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
?>  
Bienvenue utilisateur : <?php echo $user_id ?>

<form action="/controllers/do_login.php">
    Password : <input type="password" name="password"/><br/>
    <input type="submit" value="Submit"/>
    <input type ="hidden" value="<?php echo $user_id ?>"/>
</form>
<?php require_once 'footer.php'; ?>