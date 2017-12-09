<?php 
require_once 'header.php'; 
require_once '../controllers/check_login.php';
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
        $('#form_saisie_acces').hide();
        $('#nom_patient').text("Patient : " + json.nom_patient);
        $('#nom_patient').show();
        isAccesSaisi = true;
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
        $('#rfid').blur(rfidSaisieHandler);
        $.post('/ajax/ajax_patient_rfid.php',
                patientRfidReturnHandler);
    };
    $(document).ready(documentReadyHandler);
</script>
<form id="form_saisie_acces">
    <label for="rfid">Zone saisie accès</label>
    <input id="rfid" type="text"/>
</form>
<span id="nom_patient"></span>
<ul>
    <li id="prelevement_adn">Prélèvement d'ADN</li>
    <li id="creation_vecteur">Création de vecteur</li>
    <li id="administration_vecteur">Administration de vecteur</li>
</ul>
<?php require_once 'footer.php'; ?>