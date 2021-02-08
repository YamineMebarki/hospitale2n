<?php

class appointments extends database {

    public $id = 0;
    public $dateHour = '0000/00/00 00:00:00';
    public $idPatient = 0;

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type $id GET['id']
     * @return requete INSERT afin d'inserer un rdv dans ma table appointments
     */
    public function insertNewAppointments() {
        $insert = 'INSERT INTO `appointments` (`dateHour`, `idPatients`) VALUES (:dateHour, :id)';
        $insertDb = $this->db->prepare($insert);
        $insertDb->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $insertDb->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $insertDb->execute();
    }

    /**
     * verifie les occurences dans ma table appointments renvoie true ou false
     * @return bool
     */
    public function verifyAppointments() {
        //$query = 'SELECT COUNT(*) AS 'takenAppointments' FROM `appointments` WHERE `dateHour`=:dateHour AND `idPatient`=:idPatient';
        $query = 'SELECT * FROM `appointments` WHERE `dateHour`= :dateHour AND `idPatients`=:id';
        $req = $this->db->prepare($query);
        $req->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $req->bindValue(':id', $this->id, PDO::PARAM_INT);
        $req->execute();
        return $req->rowCount();
    }
    
        /**
     * Cette méthode sert à verifier que le rendez vous n'est pas déja pris
     * @return type
     */
    public function checkFreeAppointment() {
        $result = FALSE;
        $query = 'SELECT COUNT(`id`) AS `takenAppointment` FROM `appointments` WHERE `dateHour`=:dateHour AND `idPatients`=:idPatients';
        $freeAppointment = $this->db->prepare($query);
        $freeAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $freeAppointment->bindValue(':idPatients', $this->idPatient, PDO::PARAM_INT);
        if ($freeAppointment->execute()) {
            $resultObject = $freeAppointment->fetch(PDO::FETCH_OBJ);
            $result = $resultObject->takenAppointment;
        }
        return $result;
    }

    /**
     * methode permettant de recuperer la liste des rendez-vous
     * @return array
     */
    public function getListAppointments() {
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`, DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`, `appointments`.`id`, `patients`.`lastname`, `patients`.`firstname` FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` ORDER BY `patients`.`lastname`';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * methode permettant de recuperer les informations de rendez vous d'un patient 
     * @return array
     */
    public function getAppointmentsId() {
        $return = FALSE;
        $isOk = FALSE;
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`,  DATE_FORMAT(`appointments`.`dateHour`, "%Y/%m/%d") AS `dateUS`, DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`, `appointments`.`id`, `appointments`.`idPatients`,  `patients`.`lastname`, `patients`.`firstname` FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` WHERE `appointments`.`id`=:id';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($findProfil->execute()) {
            $return = $findProfil->fetch(PDO::FETCH_OBJ);
        }
            if (is_object($return)) {
                $this->id = $return->id;
                $this->dateUS = $return->dateUS;
                $this->lastname = $return->lastname;
                $this->firstname = $return->firstname;
                $this->date = $return->date;
                $this->hour = $return->hour;
                $isOk = TRUE;
                $this->idPatients = $return->idPatients;
                }
            return $isOk;
    }

    /**
     * 
     * @return requete UPDATE qui sert à modifier un rendez-vous via son id dans ma table appointments
     */
    public function updateAppointmentsId() {
        $update = 'UPDATE `appointments` SET `dateHour`=:dateHour, `idPatients`=:idPatients WHERE `id`=:id';
        $updateDb = $this->db->prepare($update);
        $updateDb->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updateDb->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $updateDb->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $updateDb->execute();
    }

    /**
     * Method qui renvoie l'affichage de la list de rendez-vous d'un patient via son id
     * @return array
     */
    public function getListAppointmentsId() {
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`, DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`, `appointments`.`id`, `appointments`.`idPatients` FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` WHERE `appointments`.`idPatients`=:id';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($findProfil->execute()) {
            $profil = $findProfil->fetchAll(PDO::FETCH_OBJ);
            if (is_object($profil)) {
                $this->id = $profil->id;
                $this->idPatients = $profil->idPatients;
                $this->lastname = $profil->lastname;
                $this->firstname = $profil->firstname;
                $this->date = $profil->date;
                $this->hour = $profil->hour;
            }
            return $profil;
        }
    }

    /**
     * @return bool
     * Method qui permet de supprimer un rendez-vous
     */
    public function deleteAppointmentsId() {
        $update = 'DELETE `appointments` FROM `appointments` WHERE `id`=:id';
        $reqDelete = $this->db->prepare($update);
        $reqDelete->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $reqDelete->execute();
    }

    /**
     * @return bool
     * Method qui permet de supprimer tout les rendez-vous d'un patient
     */
    public function deleteAppointmentsByUser() {
        $update = 'DELETE `appointments` FROM `appointments` WHERE `idPatients`=:id';
        $reqDelete = $this->db->prepare($update);
        $reqDelete->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $reqDelete->execute();
    }

}

?>
