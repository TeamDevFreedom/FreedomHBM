<?php require_once 'header.php'; ?>
<?php
session_start();
$patient_id = $_SESSION['patient_rfid'];
$etat_patient = filter_input(INPUT_GET, 'etat', FILTER_SANITIZE_URL);

echo "Etat du patient : ".$etat_patient;
//FIXME : to stuff to get patient in db
?>
<?php require_once 'footer.php'; ?>