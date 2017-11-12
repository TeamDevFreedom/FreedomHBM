<?php require_once 'header.php'; ?>
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
        if (json !== undefined && json !== null) {
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
<form id="form_saisie_acces">
    <label for="rfid">Zone saisie accès</label>
    <input id="rfid" type="text"/>
</form>
<span id="nom_patient"></span>
<ul>
    <li id="check_up">Check-up</li>
    <li id="diagnostic">Diagnostic</li>
    <li id="soins_simples">Soins simples</li>
    <li id="prepa_chirurgie">Prépa chirurgie</li>
    <li id="anesthesie">Anesthésie</li>
    <li id="reproduction">Reproduction</li>
</ul>
<?php require_once 'footer.php'; ?>