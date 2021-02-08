<?php
include 'model/config.php';
include 'model/database.php';
include 'model/patients_mdl.php';
include 'model/appointments_mdl.php';

/**
 * @param $data
 * @return string
 */
function secur($data) {
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripcslashes($data);
    return $data;
}

/**
 * @param $string
 * @return string
 */
function lowerCase($string){
    $string = strtolower($string);
    return $string;
}

/**
 * @param $string
 * @return string
 */
function upperCase($string){
    $string = strtoupper($string);
    return $string;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hospitale2n</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Staatliches" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-ligh">
    <a class="navbar-brand text-white" href="index.php"><i class="fas fa-h-square"></i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-white" href="index.php?ajout_patient"> S'enregistrer</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="index.php?ajout_patient_rendez_vous"> S'enregistrer & prendre rendez-vous</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?list_patients&page=1"> Liste des patients</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?ajout_rendez_vous"> Prendre rendez-vous</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="index.php?list_rendez_vous"> Liste des rendez-vous</a>
            </li>
        </ul>
    </div>
</nav>
<hr/>
<?php
if (isset($_GET['ajout_patient'])){
    include 'controler/ajout-patient_ctrl.php';
    include 'view/ajout-patient.php' ;
}else if (isset($_GET['list_patients'])){
    include 'controler/list-patients_ctrl.php';
    include 'view/list-patients.php' ;
}else if (isset($_GET['profil_patient']) && isset($_GET['id'])){
    include 'controler/profil_ctrl.php';
    include 'view/profil-patient.php' ;
}else if (isset($_GET['ajout_rendez_vous'])){
    include 'controler/ajout-rendezvous_ctrl.php';
    include 'view/ajout-rendezvous.php' ;
}else if (isset($_GET['list_rendez_vous'])){
    include 'controler/list-rendezvous_ctrl.php';
    include 'view/list-rendezvous.php' ;
}else if (isset($_GET['rendez_vous']) && isset($_GET['id'])){
    include 'controler/rendezvous_ctrl.php';
    include 'view/rendezvous.php' ;
}else if (isset($_GET['ajout_patient_rendez_vous'])){
    include 'controler/ajout-patient-rendez-vous_ctrl.php';
    include 'view/ajout-patient-rendez-vous.php' ;
}else{
    include 'controler/ajout-patient_ctrl.php';
    include 'view/ajout-patient.php' ;
}
?>
<script src="assets/jquery/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('input[name="phone"]').mask('00 00 00 00 00', {'translation': {0: {pattern: /[0-9*]/}}});
        $('input[name="datetime"]').mask('0000-00-00T00:00', {'translation': {0: {pattern:/[0-9*]/}}});
    });
</script>
</body>
</html>
