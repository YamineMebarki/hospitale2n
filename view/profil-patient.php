<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center bold">Profil patient :</h1>
            <table  class="table-hover table-responsive table">
                <thead>
                    <tr>
                        <th class="table-success">ID</th>
                        <th class="table-success">NOM</th>
                        <th class="table-success">PRENOM</th>
                        <th class="table-success">DATE DE NAISSANCE</th>
                        <th class="table-success">N° TELEPHONE</th>
                        <th class="table-success">ADRESSE MAIL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>                               
                        <td class="table-success" data-label="ID"><?= isset($patient->id) ? $patient->id : '' ?></td>
                        <td class="table-success" data-label="NOM"><?= isset($patient->lastname) ? $patient->lastname : '' ?></td>
                        <td class="table-success" data-label="PRENOM"><?= isset($patient->firstname) ? $patient->firstname : '' ?></td>
                        <td class="table-success" data-label="DATE DE NAISSANCE"><?= isset($patient->birthdate) ? $patient->birthdate : '' ?></td>
                        <td class="table-success" data-label="N° TEL"><?= isset($patient->phone) ? $patient->phone : '' ?></td>
                        <td class="table-success" data-label="MAIL"><?= isset($patient->mail) ? $patient->mail : '' ?></td>
                        <td class="table-success" class="text-center">
                            <form action="" method="POST">
                                <input type="submit" name="modify" class="btn btn-warning btn-sm" value="modifier profil" />
                            </form>
                        </td>
                    </tr>
                    <?php if (isset($_POST['modify'])): ?>
                    <form action="" method="POST">
                        <tr>
                            <td class="table-success"></td>
                            <td data-label="NOM" class="table-success"><input type="text" name="lastname"  title="<?= $patients->lastname ?>"  value="<?= $patients->lastname ?>"  class="form-control" id="lastname" /></td>
                            <td data-label="PRENOM" class="table-success"><input type="text" name="firstname"  title="<?= $patients->firstname ?>"  value="<?= $patients->firstname ?>"  class="form-control" id="firstname" /></td>
                            <td data-label="DATE DE NAISSANCE" class="table-success"><input type="date" name="birthdate"  title="<?= $patients->birthdateUS ?>"  value="<?= $patients->birthdateUS ?>"  class="form-control" id="birthdate" /></td>
                            <td data-label="N° TEL" class="table-success"><input type="text" name="phone"  title="<?= $patients->phone ?>"  class="form-control" value="<?= $patients->phone ?>"  id="phone" /></td>
                            <td data-label="MAIL" class="table-success"><input type="mail" name="mail"  title="<?= $patients->mail ?>"  class="form-control" value="<?= $patients->mail ?>"  id="mail" /></td>
                            <td class="text-center table-success">
                                <input type="submit" name="modify_patient" class="btn btn-success" value="valider" />
                                <hr/>
                                <a href="index.php?profil_patient&id=<?= $patient->id; ?>" ><button class="btn btn-danger">Annuler</button></a>
                            </td>
                        </tr>  
                    </form>
                <?php endif; ?>
                </tbody>
            </table>
            <h3 class="text-danger text-center"><?= isset($erreur['mail']) ? $erreur['mail'] : ''; ?></h3>
            <hr/>
            <h2 class="text-center bold">Liste des rendez-vous</h2>
            <table  class="table-hover table-responsive table">
                <thead>
                    <tr>
                        <th class="table-success">ID</th>
                        <th class="table-success">NOM</th>
                        <th class="table-success">PRENOM</th>
                        <th class="table-success">DATE</th>
                        <th class="table-success">HEURE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patientListAppointments as $patientList): ?>
                        <tr>     
                            <td class="table-success" data-label="ID"><?= isset($patient->id) ? $patient->id : '' ?></td>
                            <td class="table-success" data-label="NOM"><?= isset($patient->lastname) ? $patient->lastname : '' ?></td>
                            <td class="table-success" data-label="PRENOM"><?= isset($patient->firstname) ? $patient->firstname : '' ?></td>
                            <td class="table-success" data-label="DATE"><?= isset($patientList->date) ? $patientList->date : '' ?></td>
                            <td class="table-success" data-label="HEURE"><?= isset($patientList->hour) ? $patientList->hour : '' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <hr/>
            <div class="text-center">
                <a href="index.php?list_patients&page=1"><button type="button" class="btn btn-primary">liste des patients</button></a>
            </div>
        </div>
    </div>
</div>
