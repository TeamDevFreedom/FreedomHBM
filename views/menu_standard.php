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
    var isAccesSaisi = !$('#rfid').is(":visible");
    var idPatient;

    var redirectHandler = function (url, checkAccess = true) {
        if (!checkAccess || isAccesSaisi) {
            window.location.href = url;
        }
    }

    var rfidReturnSaisieHandler = function (output) {
        var json = JSON.parse(output);
        switch (json.status) {
            case AJAX_SUCCESS :
                $('#rfid').hide();
                $('#error').hide();
                $('#nom_patient').text("Patient : " + json.nom_patient);
                $('.menu_standard_icons').removeClass("menu_standard_icons_disabled");
                $('.nom_patient_puces').show();
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
        $('#check_up').click(function () {
            redirectHandler('check_up1.php');
        });
        $('#diagnostic').click(function () {
            redirectHandler('diagnostic.php');
        });
        $('#soins_simples').click(function () {
            redirectHandler('soins_simples.php');
        });
        $('#prepa_chirurgie').click(function () {
            redirectHandler('prepa_chirurgie.php');
        });
        $('#anesthesie').click(function () {
            redirectHandler('anesthesie.php');
        });
        $('#reproduction').click(function () {
            redirectHandler('reproduction.php');
        });
        $('#disconnect').click(function () {
            redirectHandler('home.php', false);
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
        <span id="error"></span>
    </div>
    <div class="menu_standard_icons <?php
    if (!$patient_set) {
        echo 'menu_standard_icons_disabled';
    }
    ?>">
        <div class="menu_standard_icons_row menu_standard_icons_row_top">
            <div class="menu_standard_icons_cell">
                <img src="/img/icone_check up.png" alt="Check-up" id="check_up"/>
            </div>
            <div class="menu_standard_icons_cell">
                <img src="/img/icone_diagnostic.png" alt="Diagnostic" id="diagnostic"/>
            </div>
            <div class="menu_standard_icons_cell">
                <img src="/img/icone_soins.png" alt="Soins simples" id="soins_simples"/>
            </div>
        </div>
        <div class="menu_standard_icons_row">
            <div class="menu_standard_icons_cell">
                <img src="/img/icone_chirurgie.png" alt="Préparation chirurgie" id="prepa_chirurgie"/>
            </div>
            <div class="menu_standard_icons_cell">
                <img src="/img/icone_anesthesie.png" alt="Anesthésie" id="anesthesie"/>
            </div>
            <div class="menu_standard_icons_cell">
                <img src="/img/icone_reproduction.png" alt="Reproduction" id="reproduction"/>
            </div>
        </div>
    </div>
    <div class="menu_standard_deconnexion">
        <img id="disconnect" src="/img/bouton_deconnexion.png" alt="Déconnexion"/>
    </div>
</div>
<?php require_once 'footer.php'; ?>