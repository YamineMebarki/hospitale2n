<?php
$patients = new patients();
$patients->id = secur($_GET['id']);
$patient = $patients->getPatientId();
$patientAppointments = new appointments();
$patientAppointments->id = secur($_GET['id']);
$patientListAppointments = $patientAppointments->getListAppointmentsId();

    if (isset($_POST['modify_patient'])) {
    $patients = new patients();
    $erreur = array();
    $patients->id = secur($_GET['id']);
    $patients->lastname = secur($_POST['lastname']);
    $patients->firstname = secur($_POST['firstname']);
    $patients->birthdate = secur($_POST['birthdate']);
    $patients->phone = secur($_POST['phone']);
    $patients->mail = secur($_POST['mail']);
    $patients->updatePatientId();
    $patient = $patients->getPatientId();

}

