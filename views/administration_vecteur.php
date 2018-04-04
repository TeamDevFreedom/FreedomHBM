<?php
require_once 'header.php';
require_once '../controllers/check_login.php';
require_once '../db.php';
?>
<script>
    var administrerVecteurCallback = function () {
        navigateAnimationNoResult(ANIM_CODE_ADMINISTRATION_VECTEUR);
    };
    var administrerHandler = function (event) {
        var input = {id: event.target.id};
        $.post('/ajax/ajax_administrer_vecteur.php', input, administrerVecteurCallback);
    };
    var documentReadyHandler = function () {
        $('.bt_admin_vecteur').click(administrerHandler);
        $('#bouton_retour').click(function () {
            navigate('menu_adn.php');
        });
    };
    $(document).ready(documentReadyHandler);

</script>
<?php
$patient_id = $_SESSION['patient_rfid'];
//On vérifie qu'il existe un vecteur validé pour le patient courant
$has_vecteur = false;
$vecteurs = array();
try {
    $query = $db->prepare("select * from vecteur where rfid = ? order by id desc");
    $query->execute(array($patient_id));
    if (!empty($query->rowCount())) {
        $has_vecteur = true;
    }
    while ($ligne = $query->fetch(PDO::FETCH_OBJ)) {
        $vecteur = array();
        $vecteur['description_ok'] = $ligne->description_ok;
        $vecteur['description_nok'] = $ligne->description_nok;
        $vecteur['administrable'] = false;
        $vecteur['id'] = $ligne->id;
        $vecteur['adn'] = '[ ' . $ligne->base_1 . ' ' . $ligne->base_2 . ' ' . $ligne->base_3 . ' ' . $ligne->base_4 . ' ]';
        if ($ligne->statut == "ADMINISTRE") {
            $vecteur['statut'] = "Administré";
        } else if ($ligne->statut == "CREE") {
            $vecteur['statut'] = "Création en cours";
        } else if ($ligne->statut == "PERIME") {
            $vecteur['statut'] = "Périmé";
        } else {
            $vecteur['administrable'] = true;
        }
        array_push($vecteurs, $vecteur);
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<div class="standard_page_body">
    <?php require_once './fragments/nom_patient_courant.php'; ?>
    <div class="standard_page_content">
        <div class="admin_vecteur_content">
            <?php
            $i = 0;
            $len = count($vecteurs);
            foreach ($vecteurs as $vecteur) {
                echo '<div class="admin_vecteur_ligne">';
                if (!$vecteur['administrable']) {
                    echo '<div class="admin_vecteur_adn">';
                } else {
                    echo '<div class="admin_vecteur_adn admin_vecteur_adn_pad">';
                }
                echo $vecteur['adn'];
                echo '</div>';
                echo '<div class="admin_vecteur_statut">';
                if ($vecteur['administrable']) {
                    echo '<img class="bt_admin_vecteur" src="/img/bouton_administrer.png" alt="administrer" id="' . $vecteur['id'] . '"/>';
                } else {
                    echo $vecteur['statut'];
                }
                echo '</div>';
                echo '</div>';
                if ($i < $len - 1) {
                    echo '<div class="admin_vecteur_line"></div>';
                }
                $i++;
            }
            ?>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php require_once 'footer.php'; ?>