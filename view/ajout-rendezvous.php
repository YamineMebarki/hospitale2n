<div class="container" id="rdv">
    <div class="row">
        <div class="col-12">
            <div class="text-center">
                <h1 class="font-style">Prendre un rendez-vous</h1>
                <form method="POST" action="" class="form-group border">
                    <div class="form-group"><label for="patient_id" class="bold">liste des patients enregistrer<select name="patient_id" class="form-control">
                                <?php foreach ($patientsRdv as $patient): ?>
                                    <option value="<?= $patient->id ?>"><?=  $patient->lastname . ' ' . $patient->firstname ?></option>
                            <?php endforeach; ?></label>
                        </select>
                    </div>
                    <div class="form-group">                    
                        <label for="date">Veuillez choisir une date de rendez-vous <input id="date" class="form-control" type="date" name="date" value="<?= isset($patient->date) ? $patient->date : '' ?>" min="<?= date('Y/m/d') ?>" max="2019/12/31" required /></label>
                        <label for="time">ainsi qu'une heure<input id="time" type="time" name="time" class="form-control" value="<?= isset($patient->hour) ? $patient->hour : '' ?>" min="08:00" max="18:00" required /></label>
                        <span class="validity"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" name="valideRdv" value="Réserver !">
                    </div>
                    <h2 class="text-danger"><?= isset($erreur['dateHour']) ? $erreur['dateHour'] : '' ?></h2>
                </form>
            </div>
        </div>
    </div>
</div>
