<?php
require_once 'header.php';
require_once '../controllers/check_login.php';
require_once '../db.php';

$patient_id = $_SESSION['patient_rfid'];
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_URL);
try {
    $query = $db->prepare("select * from patients where rfid = ?");
    $query->execute(array($patient_id));
    //Pas de while car on attend un résultat unique
    $resultat = $query->fetch(PDO::FETCH_OBJ);
    if ($resultat) {
        switch ($type) {
            case 'test_grossesse' :
            default :
                $img_titre = 'titre_test_grossesse.png';
                if ($resultat->sexe == 'F') {
                    $diagnostic = $resultat->test_grossesse;
                } else {
                    $diagnostic = 'Erreur : sexe incorrect';
                }
                break;
            case 'spermogramme' :
                $img_titre = 'titre_spermogramme.png';
                if ($resultat->sexe == 'H') {
                    $diagnostic = $resultat->spermogramme;
                } else {
                    $diagnostic = 'Erreur : sexe incorrect';
                }
                break;
        }
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
            navigate('reproduction.php');
        });
    };
    $(document).ready(documentReadyHandler);
</script>

<div class="standard_page_body">
    <?php require_once './fragments/nom_patient_courant.php'; ?>
    <div class="standard_page_content">
        <div class="resultat_reproduction_content">
            <div class="resultat_reproduction_titre">
                <img src="/img/<?php echo $img_titre; ?>" alt="titre"/>
            </div>
            <div class="resultat_reproduction_txt">
                <?php echo $diagnostic; ?>
            </div>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php require_once 'footer.php'; ?>