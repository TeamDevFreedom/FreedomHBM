<?php
require_once '../controllers/check_login.php';
if (isset($_SESSION['patient_rfid'])) {
    echo json_encode($_SESSION['patient_rfid']);
} else {
    echo json_encode("");
}