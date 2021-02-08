<?php
$isAppointment = FALSE;
//on appel la méthode grâce a $patients qui se trouve dans ma classe et qui me retourne un tableau stocké dans $patientsList
$patient = new Patients();
$patientsList = $patient->getListPatients();

$appointments = new Appointments();
if (!empty($_GET['id'])) {
    $appointments->id = htmlspecialchars($_GET['id']);
    $isAppointment = $appointments->getAppointmentsId();
}
$isSuccess = FALSE;
$isError = FALSE;
//Déclaration regex date
$regexDate = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
$regexHour = '/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';
$formError = [];

if (isset($_POST['modify_appointments'])) {
    if (!empty($_POST['date'])) {
        if (preg_match($regexDate, $_POST['date'])) {
            $date = $_POST['date'];
        } else {
            $formError['date'] = 'La date est invalide';
        }
    } else {
        $formError['date'] = 'La date est obligatoire';
    }

    if (!empty($_POST['time'])) {
        if (preg_match($regexHour, $_POST['time'])) {
            $hour = $_POST['time'];
        } else {
            $formError['time'] = 'L\'heure est invalide';
        }
    } else {
        $formError['time'] = 'L\'heure est obligatoire';
    }

    if (!empty($_POST['idPatients'])) {
        if (is_numeric($_POST['idPatients'])) {
            $idPatients = $_POST['idPatients'];
        } else {
            $formError['idPatients'] = 'Le patient est invalide';
        }
    } else {
        $formError['idPatients'] = 'Le patient est obligatoire';
    }
    if (count($formError) == 0) {
        $updateAppointment = new appointments();
        $updateAppointment->id = $_GET['id'];
        $updateAppointment->dateHour = $date . ' ' . $hour;
        $updateAppointment->idPatients = $idPatients;
        $updateAppointment->updateAppointmentsId();
        header('location:index.php?rendez_vous&id='.$_GET['id']);
    }
}
?>