<?php
//si valider existe alor.
if (isset($_POST['valider'])) {
        $erreur = array();
        //Instenciation de l'objet newsPatients. 
        //la methode magique construct est appelée automatiquement grace au mot clé new.
        //$newsPatient devient une instance de la classe ajoutNewsPatients.
        $newsPatient = new patients();
        $regexName = '#[a-zA-Z \- \s çéêèâîûôÇÔÛÎÉÊÈÂ]+$#';
        $regexNumber = '#[0-9\s]{10}+$#';
        $regexDate = '#[0-9 / -]{8}+$#';
        $newsPatient->lastname = secur(upperCase($_POST['lastname']));
        $newsPatient->firstname = secur(lowerCase($_POST['firstname']));
        $newsPatient->birthdate = secur($_POST['birthdate']);
        $newsPatient->phone = secur($_POST['phone']);
        $newsPatient->mail = secur(lowerCase($_POST['mail1']));
        $mail2 = secur(lowerCase($_POST['mail2']));
    // je verifie si mes poste son different de vide 
    if (!empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['birthdate']) && !empty($_POST['phone']) && !empty($_POST['mail1']) && !empty($_POST['mail2'])) {
        // regex de mon input firstname
        if (preg_match($regexName, $newsPatient->firstname)) {
            //regex de mon input lastname
            if (preg_match($regexName, $newsPatient->lastname)) {
                // regex de ma date si quelqu'un modifie le type champs seul des format date seron accepter
                if (preg_match($regexDate, $newsPatient->birthdate)) {
                // regex de mon input phone     
                if (preg_match($regexNumber, $newsPatient->phone)) {
                    // je verifie la confirmation de mon adresse mail
                    if ($newsPatient->mail == $mail2) {
                        // je verifie que l'adresse entrer est bien une adresse mail
                        if (filter_var($newsPatient->mail, FILTER_VALIDATE_EMAIL)) {
                            // j'utilise ma method verifyMail afin de verifier l'occurence de mon mail dans ma table
                            $newsPatient->verifyMail();
                            // si adresse mail n'existe pas dans ma table alor je creer mon profil
                            if ($newsPatient->verifyMail() == 0 ) {
                                $newsPatient->insertNewsPatients();                              
                                header('location:index.php?list_patients');
                            } else {
                                $erreur['mail'] = 'Cette adresse mail est deja utiliser';
                            }
                        } else {
                            $erreur['mail'] = 'Cette adresse mail n\'est pas valide';
                        }
                    } else {
                        $erreur['mail'] = 'Vos adresses mail ne correspondent pas';
                    }
                } else {
                    $erreur['phone'] = 'Votre numero de telephone comporte une erreur';
                }
            }else {
                $erreur['birthdate'] = 'Votre date ne correspond pas';
            }
            } else {
                $erreur['lastname'] = 'Votre nom comporte une erreur';
            }
        } else {
            $erreur['firstname'] = 'Votre prenom comporte une erreur';
        }
    } else {
        $erreur['error'] = 'Veuillez remplir tous les champs pour vous inscrire';
    }
}
?>
