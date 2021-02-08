<?php
$erreur = array();
$patients = new patients();
$patientsRdv = $patients->getListPatients();
if (isset($_POST['valideRdv'])) {
    $patients = new appointments();
    $patients->id = secur($_POST['patient_id']);
    $patients->dateHour = secur($_POST['date'].' '.$_POST['time'] );
    if ($patients->verifyAppointments() == 0) {
        $patients->insertNewAppointments();
        header('location:index.php?list_rendez_vous');
    } else {
        $erreur["dateHour"] = 'Veuillez choisir une autre date de rendez-vous s\'il vous plaît';
    }
}
