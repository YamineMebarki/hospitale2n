<?php

class patients extends database {

    public $perPage = 5;
    public $id = 0;
    public $lastname = '';
    public $firstname = '';
    public $birthdate = '00/00/0000 00:00:00';
    public $birthdateUS = '0000/00/0000 00:00:00';
    public $phone = '0000000000';
    public $mail = '';
    public $query = '';

    /**
     * Method construct qui ce connecte a ma base de données
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Method qui sert a inserer un nouveau patient
     * @return requete INSERT
     */
    public function insertNewsPatients() {
        $insert = 'INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES (:lastname, :firstname, :birthdate, :phone, :mail)';
        $insertDb = $this->db->prepare($insert);
        $insertDb->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $insertDb->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $insertDb->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $insertDb->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $insertDb->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $insertDb->execute();
    }

    /**
     * Method qui compte le nombre de ligne dans ma table et me les divise par le nombre d'affichage souhaiter afin d'en renvoyer un nombre de pages
     * @return int
     */
    public function paginationPatients() {
        $req = 'SELECT COUNT(*) FROM `patients`;';
        $nbPost = $this->db->query($req)->fetchColumn();
        $pagination = ceil($nbPost / $this->perPage);
        return $pagination;
    }

    /**
     * Method qui sert a afficher ma list des patients
     * @return array
     */
    public function getListPatients() {
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, \'%d/%m/%Y\') AS `birthdate`, `phone`, `mail` FROM `patients` ORDER BY `id` ASC ';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * methode permettant de recuperer la liste des patients via la pagination
     * @return array
     */
    public function getListPatientsPage() {
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, \'%d/%m/%Y\') AS `birthdate`, `phone`, `mail` FROM `patients` ORDER BY `id` ASC LIMIT :page,' . $this->perPage;
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':page', $this->id, PDO::PARAM_INT);
        if ($findProfil->execute()) {
            $profil = $findProfil->fetchAll(PDO::FETCH_OBJ);
            if (is_object($profil)) {
                $this->id = $profil->id;
            }
            return $profil;
        }
    }

    /**
     * methode permettant de recuperer les informations d'un patient via son id
     * @return array
     */
    public function getPatientId() {
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`,  DATE_FORMAT(`birthdate`, "%Y/%m/%d") AS `birthdateUS`, `phone`, `mail` FROM `patients` WHERE `id`= :id';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($findProfil->execute()) {
            $profil = $findProfil->fetch(PDO::FETCH_OBJ);
            if (is_object($profil)) {
                $this->lastname = $profil->lastname;
                $this->firstname = $profil->firstname;
                $this->birthdate = $profil->birthdate;
                $this->birthdateUS = $profil->birthdateUS;
                $this->phone = $profil->phone;
                $this->mail = $profil->mail;
            }
            return $profil;
        }
    }

    /**
     * Method qui renvoi true si il y a des occurences sur ma colonne mail de ma table patients sinon false
     * @return bool
     */
    public function verifyMail() {
        $reqmail = $this->db->prepare('SELECT `mail` FROM `patients` WHERE `mail`= :mail');
        $reqmail->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $reqmail->execute();
        return $reqmail->rowCount();
    }

    /**
     * Method qui sert à modifier un patient via son id
     * @return requete UPDATE
     */
    public function updatePatientId() {
        $update = 'UPDATE `patients` SET `lastname`=:lastname, `firstname`=:firstname, `birthdate`=:birthdate, `phone`=:phone, `mail`=:mail WHERE `id`=:id';
        $updateDb = $this->db->prepare($update);
        $updateDb->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updateDb->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $updateDb->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $updateDb->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $updateDb->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $updateDb->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $updateDb->execute();
    }

    /**
     * Method qui sert à supprimer un patient via son id
     * @return arrray
     */
    public function deletePatientId() {
        $update = 'DELETE `patients` FROM `patients` WHERE `id`=:id';
        $reqDelete = $this->db->prepare($update);
        $reqDelete->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $reqDelete->execute();
    }

    /**
     * Method qui retourne l'affichage d'une recherche selectionner dans ma requete grace a mon bindValue :query
     * @return array
     */
    public function queryPatient() {
        $query = 'SELECT * FROM `patients` WHERE `lastname` LIKE :query OR `lastname` LIKE :query';
        $reqQuery = $this->db->prepare($query);
        $reqQuery->bindValue(':query', '%' . $this->query . '%', PDO::PARAM_STR);
        $reqQuery->execute();
        return $reqQuery->fetchAll(PDO::FETCH_OBJ);
    }

    public function getLastId(){
        $query = 'SELECT LAST_INSERT_ID(id) FROM `patients`';
        $reqQuery = $this->db->prepare($query);
        $reqQuery->execute();
        return $reqQuery->fetchAll(PDO::FETCH_OBJ);
    }

}

?>