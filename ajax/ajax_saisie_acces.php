<?php
require_once '../controllers/check_login.php';
$_SESSION['patient_rfid'] = 0;
echo json_encode(array('nom_patient' => 'John Doe'));