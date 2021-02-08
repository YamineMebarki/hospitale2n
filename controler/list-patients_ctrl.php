<?php
//Instenciation de l'objet patients. 
//$patients devient une instance de la classe patients.
//la methode magique construct est appelée automatiquement 
//grace au mot clé new.
$patients = new patients();
$erreur = array();
$page = $patients->paginationPatients();
if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $page) {
    $_GET['page'] = intval($_GET['page']);
    $patients->id = (($_GET['page'] - 1) * 5);
    $patientsList = $patients->getListPatientsPage();
} else {
    $patientsList = $patients->getListPatients();
}
if (isset($_POST['delete_patient']) && isset($_POST['id_patient'])) {
    $appointement = new appointments();
    $appointement->id = $_POST['id_patient'];
    $appointement->deleteAppointmentsByUser();
    $patients->id = $_POST['id_patient'];
    $patients->deletePatientId();
    if (isset($_GET['page'])){
        header('location:index.php?list_patients&page='.$_GET['page']);
    }else{
        header('location:index.php?list_patients');
    }
}
if (isset($_POST['search']) && isset($_POST['query'])) {
    $patients->query = secur($_POST['query']);
    $patternQuery = '#[a-zA-Z]#';
    if (preg_match($patternQuery, $patients->query)) {
        if ($patients->queryPatient() == TRUE) {
            $patientsList = $patients->queryPatient();
        } else {
            $erreur['query'] = 'Aucun resultats ne correspond a votre recherche';
        }
    } else {
        $erreur['query'] = 'Verifiez le format des données entrer';
    }
}
?>