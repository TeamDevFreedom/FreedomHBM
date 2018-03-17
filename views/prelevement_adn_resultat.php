<?php
require_once 'header.php';
require_once '../controllers/check_login.php';
require_once '../db.php';

$patient_id = $_SESSION['patient_rfid'];

try {
    $query = $db->prepare("select * from adn where rfid = ?");
    $query->execute(array($patient_id));
//Pas de while car on attend un résultat unique
    $resultat = $query->fetch(PDO::FETCH_OBJ);
    if ($resultat) {
        $base_1 = $resultat->base_1;
        $base_2 = $resultat->base_2;
        $base_3 = $resultat->base_3;
        $base_4 = $resultat->base_4;
//Le séquençage ayant réussi, on l'indique comme effectué dans la BDD
        $query_mark = $db->prepare("update adn a set a.prelevement_effectue = 'T' where a.rfid = ?");
        $query_mark->execute(array($patient_id));
    } else {
//Erreur : patient non trouvé : on redirige vers la page d'accueil
        header('Location: /views/home.php');
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<script>
    var documentReadyHandler = function () {
        $('#bouton_retour').click(function () {
            navigate('prelevement_adn.php');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<div class = "standard_page_body">
    <?php require_once './fragments/nom_patient_courant.php';
    ?>
    <div class="standard_page_content">
        <div class="prelevement_adn_resultat_content">
            <img src="/img/titre_grp_sanguin.png" alt="titre"/>
            <div class="prelevement_adn_resultat_bases">
                <div class="prelevement_adn_resultat_base"><div><?php echo $base_1; ?></div></div>
                <div class="prelevement_adn_resultat_base"><div><?php echo $base_2; ?></div></div>
                <div class="prelevement_adn_resultat_base"><div><?php echo $base_3; ?></div></div>
                <div class="prelevement_adn_resultat_base"><div><?php echo $base_4; ?></div></div>
            </div>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php
require_once 'footer.php';
