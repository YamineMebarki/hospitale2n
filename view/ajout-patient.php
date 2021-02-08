<div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="form-group text-center">
                        <h1 class="font-style mb-4">S'enregistrer :</h1>
                        <form method="POST" action="" class="border">
                            <div class="form-group mt-5"><label for="lastname"><b>Nom :</b><input type="text" name="lastname" id="lastname" class="form-control" placeholder="NOM" value="<?= isset($newsPatient->lastname) ? $newsPatient->lastname : '' ?>" /></label></div>
                            <p class="text-danger text-center"><?= isset($erreur['lastname']) ? $erreur['lastname'] : '' ?></p>                 
                            <div class="form-group"><label for="firstname"><b>Prenom :</b><input type="text" name="firstname" id="firstname" class="form-control" placeholder="PRENOM" value="<?= isset($newsPatient->firstname) ? $newsPatient->firstname : '' ?>" /></label></div>
                            <p class="text-danger text-center"><?= isset($erreur['firstname']) ? $erreur['firstname'] : '' ?></p>                 
                            <div class="form-group"><label for="birthdate"><b>Date de naissance :</b><input type="date" name="birthdate" id="birthdate" class="form-control" placeholder="DATE DE NAISSANCE" value="<?= isset($newsPatient->birthdate) ? $newsPatient->birthdate : '' ?>" /></label></div>
                            <p class="text-danger text-center"><?= isset($erreur['birthdate']) ? $erreur['birthdate'] : '' ?></p> 
                            <div class="form-group"><label for="phone"><b>N° tel :</b><input type="text" name="phone" id="phone" class="form-control" placeholder="NUMERO TEL" value="<?= isset($newsPatient->phone) ? $newsPatient->phone : '' ?>" /></label></div>
                            <p class="text-danger text-center"><?= isset($erreur['phone']) ? $erreur['phone'] : '' ?></p> 
                            <div class="form-group"><label for="mail1"><b>eMail :</b><input type="mail" name="mail1" id="mail" class="form-control" placeholder="ADRESSE MAIL" value="<?= isset($newsPatient->mail) ? $newsPatient->mail : '' ?>" /></label></div>
                            <p class="text-danger text-center"><?= isset($erreur['mail']) ? $erreur['mail'] : '' ?></p>                 
                            <div class="form-group"><label for="mail2"><b>Confirm eMail :</b><input type="mail" name="mail2" id="mail" class="form-control" placeholder="CONFIRM MAIL" value="<?= isset($mail2) ? $mail2 : '' ?>" /></label></div>
                            <p class="text-danger text-center"><?= isset($erreur['mail']) ? $erreur['mail'] : '' ?></p>                 
                            <div class="form-group mb-5"><label for="valider"><input type="submit" name="valider" id="valider" value="Valider" class="btn btn-primary" /></label></div>
                        </form>
                        <h2 class="text-danger text-center"><?= isset($erreur['error']) ? $erreur['error'] : '' ?></h2>
                    </div>
                </div>
            </div>
        </div>
