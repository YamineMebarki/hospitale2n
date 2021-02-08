<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center font-style">Detail rendez-vous :</h1>
            <?php if ($isAppointment): ?>
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
                        <tr>                               
                            <td class="table-success" data-label="ID"><?= isset($appointments->id) ? $appointments->id : '' ?></td>
                            <td class="table-success" data-label="NOM"><?= isset($appointments->lastname) ? $appointments->lastname : '' ?></td>
                            <td class="table-success" data-label="PRENOM"><?= isset($appointments->firstname) ? $appointments->firstname : '' ?></td>
                            <td class="table-success" data-label="DATE"><?= isset($appointments->date) ? $appointments->date : '' ?></td>
                            <td class="table-success" data-label="HEURE"><?= isset($appointments->hour) ? $appointments->hour : '' ?></td>
                            <td class="table-success" class="text-center">
                                <form action="" method="POST">
                                    <input type="submit" name="modify" class="btn btn-warning btn-sm" value="modifier le rendez vous" />
                                </form>
                            </td>
                        </tr>
                    <?php else : ?>
                    <p class="text-danger text-center">Le rendez-vous n'a pas été trouvé</p>
                <?php endif; ?>
                <?php if ($isSuccess) { ?>
                    <p class="text-success">Votre rendez-vous a bien été prises en compte</p>
                    <?php
                }
                if ($isError) {
                    ?>
                    <p class="text-danger">Désolé, votre rendez-vous n'a pu être enregistré !</p>
                    <?php
                }
                ?>
                <?php if (isset($_POST['modify'])): ?>
                    <form action="" method="POST">
                        <tr>  
                            <td  class="table-success"></td>
                            <td  class="table-success"></td>
                            <td data-label="PROFIL" class="table-success">
                                <select name="idPatients" class="form-control">
                                    <?php foreach ($patientsList as $patients) { ?>
                                        <!-- Si l'id du rdv existe et que l'id du patient est égale à l'id patient du rdv alors je rajoute l'attribut selected  -->
                                        <option value="<?= $patients->id ?>" <?= isset($appointments->idPatients) && ($patients->id == $appointments->idPatients) ? 'selected' : '' ?>><?= $patients->id . ' ' . $patients->lastname . ' ' . $patients->firstname ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td data-label="DATE" class="table-success"><input type="date" name="date" class="form-control" title="<?= $appointments->date ?>" value="<?= $appointments->dateUS ?>"  id="date" /></td>
                            <td data-label="HEURE" class="table-success"><input type="time" name="time" class="form-control" title="<?= $appointments->hour ?>" value="<?= $appointments->hour ?>"  id="time" /></td>
                            <td class="text-center table-success">
                                <input type="submit" name="modify_appointments" class="btn btn-success" value="valider" />
                                <hr/>
                                <a href="index.php?rendez_vous&id=<?= $patient->id; ?>" ><button class="btn btn-danger">Annuler</button></a>
                            </td>
                        </tr>  
                    </form>
                <?php endif; ?>
                </tbody>
            </table>
            <h3 class="text-danger text-center"><?= isset($formError['date']) ? $formError['date'] : ''; ?></h3>
            <h3 class="text-danger text-center"><?= isset($formError['time']) ? $formError['time'] : ''; ?></h3>
            <h3 class="text-danger text-center"><?= isset($formError['idPatients']) ? $formError['idPatients'] : ''; ?></h3>
            <div class="text-center">
                <a href="index.php?list_rendez_vous"><button type="button" class="btn btn-primary">liste des rendez-vous</button></a>
            </div>
        </div>
    </div>
</div>