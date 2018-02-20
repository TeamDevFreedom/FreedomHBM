<?php

require_once '../controllers/check_login.php';
require_once 'header.php';
require_once '../ajax/ajax_utils.php';
?>
<script>
    var isAccesSaisi = false;
    var idPatient;

    var redirectHandler = function (url) {
        if (isAccesSaisi) {
            window.location.href = url;
        }
    };

    var patientRfidReturnHandler = function (output) {
        console.log("patientIdReturnHandler : output : " + output);
        var json = JSON.parse(output);
        console.log("json : " + json);
        if (json !== undefined && json !== null && json !== "") {
            var input = {rfid: json};
            $.post('/ajax/ajax_saisie_acces.php',
                    input, rfidReturnSaisieHandler);
        }
    };

    var rfidReturnSaisieHandler = function (output) {
        var json = JSON.parse(output);
        switch (json.status) {
            case AJAX_SUCCESS :
                $('#rfid').hide();
                $('#error').hide();
                $('#nom_patient').text("Patient : " + json.nom_patient);
                $('#nom_patient').show();
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
        $('#rfid').blur(rfidSaisieHandler);
        $.post('/ajax/ajax_patient_rfid.php',
                patientRfidReturnHandler);
    };
    $(document).ready(documentReadyHandler);
</script>
<div class="menu_standard_container">
    <div class="menu_standard_saisie">
        <input class="menu_standard_container_rfid" id="rfid" type="text"/>
        <span class="menu_standard_container_nom" id="nom_patient"></span>
        <span id="error"></span>
    </div>
    <div class="menu_standard_icons">
        <div class="menu_standard_icons_row">
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
</div>
<?php require_once 'footer.php'; ?>