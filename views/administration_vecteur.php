<?php
require_once 'header.php';
require_once '../controllers/check_login.php';
require_once '../db.php';
?>
<script>
    var administrerVecteurCallback = function (output) {
        alert(output);
        var json = JSON.parse(output);
        switch (json.status) {
            case AJAX_SUCCESS :
                window.location.href = '/views/administration_vecteur.php';
                break;
            case AJAX_FAILURE :
                //FIXME
                alert(json.message);
                break;
            case AJAX_ERROR :
                alert(json.message);
                break;
        }
    };
    var administrerHandler = function (event) {
        var input = {id: event.target.id};
        $.post('/ajax/ajax_administrer_vecteur.php', input, administrerVecteurCallback);
    };
    var documentReadyHandler = function () {
        $('.admin_vecteur').click(administrerHandler);
    };
    $(document).ready(documentReadyHandler);

</script>
<?php
$patient_id = $_SESSION['patient_rfid'];
//On vérifie qu'il existe un vecteur validé pour le patient courant
try {
    $query = $db->prepare("select * from vecteur where rfid = ?");
    $query->execute(array($patient_id));
    if (empty($query->rowCount())) {
        echo "Il n'existe aucun vecteur pour cet utilisateur";
        return;
    }
    while ($ligne = $query->fetch(PDO::FETCH_OBJ)) {
        echo "Description du vecteur : " . $ligne->description . " ";
        if ($ligne->statut == "ADMINISTRE") {
            echo "Administré";
        } else if ($ligne->statut == "CREE") {
            echo "En cours de création";
        } else {
            ?>
            <input type = 'submit' class='admin_vecteur' value = 'Administrer le vecteur' id='<?php echo $ligne->id ?>'/>
            <?php
        }
        echo "<br/>";
    }
    $query->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>