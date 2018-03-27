<?php
require_once '../controllers/check_login.php';
require_once 'header.php';
require_once '../ajax/ajax_utils.php';
$patient_set = isset($_SESSION['patient_rfid']);
if ($patient_set) {
    $patient_nom = $_SESSION['patient_nom'];
}
?>
<script>

    var redirectHandler = function (url) {
        if (!$('#rfid').is(":visible")) {
            navigate(url);
        }
    }

    var rfidReturnSaisieHandler = function (output) {
        var json = JSON.parse(output);
        switch (json.status) {
            case AJAX_SUCCESS :
                $('.menu_adn_icons').removeClass("menu_adn_icons_disabled");
                $('.nom_patient_puces').show();
                $('#nom_patient').text("Patient : " + json.nom_patient);
                $('#rfid').hide();
                $('#error').hide();
                //Workaround pour forcer un recalcul et éviter l'étrange pb de largeur des icones
                $('.menu_adn_icons').show();
                isAccesSaisi = true;
                break;
            case AJAX_FAILURE :
                $('#error').text(json.message);
                $('#error').show();
                break;
            case AJAX_ERROR :
                alert(json.message);
                break;
        }
    };

    var rfidSaisieHandler = function () {
        saisieRfid = $('#rfid').val();
        if (saisieRfid) {
            var input = {rfid: saisieRfid};
            $.post('/ajax/ajax_saisie_acces.php',
                    input, rfidReturnSaisieHandler);
        }

    };
    var documentReadyHandler = function () {
        $('#prelevement_adn').click(function () {
            redirectHandler('prelevement_adn.php');
        });
        $('#creation_vecteur').click(function () {
            redirectHandler('creation_vecteur.php');
        });
        $('#administration_vecteur').click(function () {
            redirectHandler('administration_vecteur.php');
        });
        $('#disconnect').click(function () {
            navigate('home.php');
        });
        $('#rfid').blur(rfidSaisieHandler);
        $('#rfid').keypress(function (e) {
            if (e.which === 13) {
                rfidSaisieHandler();
            }
        });
    };
    $(document).ready(documentReadyHandler);
</script>
<div class="menu_standard_container">
    <div class="menu_standard_saisie">
        <input class="menu_standard_container_rfid" id="rfid" type="text" <?php
        if ($patient_set) {
            echo "style='display:none'";
        }
        ?> />
        <div class="nom_patient_puces"  <?php
        if (!$patient_set) {
            echo "style='display:none'";
        }
        ?>>
            <img src="/img/puce.png" alt="puce"/>
            <span class="patient_nom" id="nom_patient"><?php
                if ($patient_set) {
                    echo 'Patient : ' . $patient_nom;
                }
                ?></span>
            <img src="/img/puce.png" alt="puce"/>
        </div>
        <span id="error" style="display:none"></span>
    </div>
    <div class="menu_adn_icons <?php
    if (!$patient_set) {
        echo 'menu_adn_icons_disabled';
    }
    ?>">
        <img src="/img/icone_prelevement_adn.png" alt="Prélèvement d'ADN" id="prelevement_adn"/>
        <img src="/img/icone_crea_vecteur.png" alt="Création de vecteur" id="creation_vecteur"/>
        <img src="/img/icone_admin_vecteur.png" alt="Administraction de vecteur" id="administration_vecteur"/>
    </div>
    <div class="menu_standard_deconnexion">
        <img id="disconnect" src="/img/bouton_deconnexion.png" alt="Déconnexion"/>
    </div>
</div>
<?php require_once 'footer.php'; ?>