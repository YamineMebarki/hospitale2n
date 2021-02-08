<?php
$patients = new appointments();
$patientsRdv = $patients->getListAppointments();
if (isset($_POST['delete_appointments']) && isset($_POST['id_appointments'])) {
    $patients->id = $_POST['id_appointments'];
    $patients->deleteAppointmentsId();
    header('location:index.php?list_rendez_vous');
}
?>
