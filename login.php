<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Accueil</title>
        <!--<link rel="stylesheet" href="style.css">-->
        <script src="./scripts/jquery.js"></script>
        <script>
        </script>

    </head>
    <body>
        <?php
        $user_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_URL);
        ?>  
        Bienvenue utilisateur : <?php echo $user_id ?>

        <form action="/do_login.php">
            Password : <input type="password" name="password"/><br/>
            <input type="submit" value="Submit"/>
            <input type ="hidden" value="<?php echo $user_id ?>"/>
        </form>
    </body>
</html>