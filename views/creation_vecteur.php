<?php
require_once 'header.php';
require_once '../controllers/check_login.php';
require_once '../db.php';

$patient_id = $_SESSION['patient_rfid'];
//On vérifie qu'il n'y a pas déjà un vecteur en création
try {
    $query = $db->prepare("select count(1) from vecteur where statut = 'CREE' and rfid = ?");
    $query->execute(array($patient_id));
    $count = $query->fetchColumn();
    $query->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}
$en_creation = ($count > 0);

//Génération de la liste
function generate_list_patients_content($db) {
    $liste_patients = "";
    try {
        $query = $db->prepare("select p.rfid, p.nom "
                . "from patients p "
                . "inner join adn a "
                . "on p.rfid = a.rfid "
                . "where a.prelevement_effectue = 'T'");
        $query->execute();
        $liste_patients .= '<option value="-1">-- Sélectionnez un patient --</option>';
        while ($ligne = $query->fetch(PDO::FETCH_OBJ)) {
            $liste_patients .= '<option value="' . $ligne->rfid . '">' . $ligne->nom . '</option>';
        }
        $query->closeCursor();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $liste_patients;
}
?>
<script>
    var listeChangedHandler = function () {
        var id = $(this).val();
        if (id !== "-1") {
            var input = {rfid: id};
            $.post('/ajax/ajax_get_adn_patient.php', input, getADNHandler);
        }else{
            $('#creation_vecteur_saisie *').hide();
        }
    };

    var getADNHandler = function (output) {
        alert(output);
        var json = JSON.parse(output);
        switch (json.status) {
            case AJAX_SUCCESS :
                $('#adn_1').text(json.base1);
                $('#adn_2').text(json.base2);
                $('#adn_3').text(json.base3);
                $('#adn_4').text(json.base4);
                $('#error').hide();
                $('#creation_vecteur_saisie *').show();
                break;
            case AJAX_FAILURE :
                $('#error').text(json.message);
                $('#error').show();
                $('#creation_vecteur_saisie *').hide();
                break;
            case AJAX_ERROR :
                $('#creation_vecteur_saisie *').hide();
                alert(json.message);
                break;
        }
    };

    var creerVecteurCallback = function (output) {
        var json = JSON.parse(output);
        switch (json.status) {
            case AJAX_SUCCESS :
                window.location.href = 'views/creation_vecteur.php';
                break;
            case AJAX_FAILURE :
                alert(json.message);
                break;
            case AJAX_ERROR :
                $('#creation_vecteur_saisie *').hide();
                alert(json.message);
                break;
        }
    }

    var vecteurKeyUpHandler = function (event) {
        var val = String.fromCharCode(event.which).toUpperCase();
        if (val === 'A' || val === 'T' || val === 'G' || val === 'C') {
            $(this).val(val);
        }
        event.preventDefault();
    };

    var creerVecteurHandler = function () {
        var input = {
            vecteur_1: $("#vecteur_1").val(),
            vecteur_2: $("#vecteur_2").val(),
            vecteur_3: $("#vecteur_3").val(),
            vecteur_4: $("#vecteur_4").val(),
            patient_id: $("#liste_patients").val()
        };
        $.post('/ajax/ajax_creer_vecteur.php', input, creerVecteurCallback);
    };

    var documentReadyHandler = function () {
        $('#liste_patients').change(listeChangedHandler);
        $('#btn_vecteur').click(creerVecteurHandler);
        $("#vecteur_1").keypress(vecteurKeyUpHandler);
        $("#vecteur_2").keypress(vecteurKeyUpHandler);
        $("#vecteur_3").keypress(vecteurKeyUpHandler);
        $("#vecteur_4").keypress(vecteurKeyUpHandler);
    };
    $(document).ready(documentReadyHandler);
</script>
<div class = "standard_page_body">
    <div class="standard_page_header"></div>
    <div class="standard_page_content">
        <div class="creation_vecteur_content">
            <div class="creation_vecteur_list">
                <select id="liste_patients">
                    <?php echo generate_list_patients_content($db); ?>
                </select>
            </div>
            <div id ="creation_vecteur_saisie" class="creation_vecteur_saisie">
                <div id="adn" class="creation_vecteur_show_adn" style='display:none'>
                    <span id = 'adn_1'></span>
                    <span id = 'adn_2'></span>
                    <span id = 'adn_3'></span>
                    <span id = 'adn_4'></span>
                </div>
                <div id="vecteur" class="creation_vecteur_saisie_adn" style='display:none'>
                    <input type="text" id = 'vecteur_1' maxlength='1'/>
                    <input type="text" id = 'vecteur_2' maxlength='1'/>
                    <input type="text" id = 'vecteur_3' maxlength='1'/>
                    <input type="text" id = 'vecteur_4' maxlength='1'/>
                </div>
                <div class="creation_vecteur_creer">
                    <img src="/img/bouton_enter.png" alt="Créer" id="btn_vecteur" style='display:none'/>
                </div>
            </div>
        </div>
    </div>
    <?php require_once './fragments/bouton_retour.php' ?>
</div>
<?php
require_once 'footer.php';
