<?php
require_once 'header.php';
require_once '../controllers/check_login.php';
require_once '../db.php';

function generer_bpm($etat_patient) {
    switch ($etat_patient) {
        case 'calme':
        default :
            $min = 700;
            $max = 800;
            break;
        case 'agite':
            $min = 800;
            $max = 950;
            break;
        case 'tres_agite':
            $min = 950;
            $max = 1150;
            break;
    }
    return rand($min, $max) / 10.0;
}

function generer_heart_img($etat_patient){
    switch ($etat_patient) {
        case 'calme':
        default :
            return "heart.gif";
        case 'agite':
            return "heart_medium.gif";
        case 'tres_agite':
            return "heart_fast.gif";
    }
}

function generer_systole($etat_patient) {
    switch ($etat_patient) {
        case 'calme':
        default :
            $min = 90;
            $max = 120;
            break;
        case 'agite':
            $min = 121;
            $max = 139;
            break;
        case 'tres_agite':
            $min = 140;
            $max = 179;
            break;
    }
    return rand($min, $max) / 10.0;
}

function generer_diastole($etat_patient) {
    switch ($etat_patient) {
        case 'calme':
        default :
            $min = 60;
            $max = 80;
            break;
        case 'agite':
            $min = 81;
            $max = 89;
            break;
        case 'tres_agite':
            $min = 90;
            $max = 109;
            break;
    }
    return rand($min, $max) / 10.0;
}

function generer_tension($etat_patient) {
    return generer_systole($etat_patient) . " / " . generer_diastole($etat_patient);
}

$patient_id = $_SESSION['patient_rfid'];
$etat_patient = filter_input(INPUT_GET, 'etat', FILTER_SANITIZE_URL);

try {
    $query = $db->prepare("select * from patients where rfid = ?");
    $query->execute(array($patient_id));
    //Pas de while car on attend un résultat unique
    $resultat = $query->fetch(PDO::FETCH_OBJ);
    if ($resultat) {
        switch ($etat_patient) {
            case 'calme':
            default :
                $infos_etat = $resultat->etat_patient_calme;
                break;
            case 'agite':
                $infos_etat = $resultat->etat_patient_agite;
                break;
            case 'tres_agite':
                $infos_etat = $resultat->etat_patient_agite;
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
$tension = generer_tension($etat_patient);
$pulsation = generer_bpm($etat_patient);
$heart_img = generer_heart_img($etat_patient);
?>
<script>
    var redirectHandler = function (url) {
        window.location.href = url;
    };
    
    var documentReadyHandler = function () {
        $('#bouton_retour').click(function () {
            redirectHandler('check_up1.php');
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<div class="standard_page_body">
    <?php require_once './fragments/nom_patient_courant.php'; ?>
    <div class="standard_page_content">
        <div class="check_up_2_content">
            <div class="check_up_2_left">
                <div class="check_up_2_sang">
                    <img src="/img/titre_grp_sanguin.png" alt="titre"/>
                    <div class="check_up_2_sang_txt">
                        <?php echo $resultat->groupe_sanguin.' / '.$resultat->infos_sang ?>
                    </div>
                </div>
                <div class="check_up_2_cardio">
                    <img src="/img/<?php echo $heart_img ?>" alt="cardio">
                    <div class="check_up_2_cardio_txt">
                        <b>Tension : </b><?php echo $tension ?>
                        <br/>
                        <b>Pulsation : </b><?php echo $pulsation ?> BPM
                    </div>
                </div>
            </div>
            <div class="check_up_2_right">
                <div class="check_up_2_listing_container">
                    <div class="check_up_2_listing">
                        <?php echo $infos_etat ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php
//echo "Etat : " . $infos_etat . "<br/>";
//echo "Tension : " . $tension . "<br/>";
//echo "Groupe sanguin : " . $resultat->groupe_sanguin . "<br/>";
//echo "Informations sanguines : " . $resultat->infos_sang . "<br/>";
//FIXME
//echo "<script>play_anim(ANIM_CODE_CHECK_UP)</script>";
require_once 'footer.php';
