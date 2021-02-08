<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center font-style">Liste des rendez-vous :</h1>
            <table class="table-hover table-responsive table">
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
                    <?php foreach ($patientsRdv as $patient): ?>
                        <tr>
                            <td class="table-success" data-label="ID :"><?= $patient->id ?></td>
                            <td class="table-success" data-label="NOM :"><?= $patient->lastname ?></td>
                            <td class="table-success" data-label="PRENOM :"><?= $patient->firstname ?></td>
                            <td class="table-success" data-label="DATE :"><?= $patient->date ?></td>
                            <td class="table-success" data-label="HEURE:"><?= $patient->hour ?></td>
                            <td class="table-success" data-label="DÉTAILS"><a href="index.php?rendez_vous&id=<?= $patient->id; ?>" class="text-black-50">en savoir plus</a></td>
                            <td class="text-center table-success">
                                <form action="" method="POST">
                                    <input type="hidden" name="id_appointments" value="<?= $patient->id ?>">
                                    <input type="submit" name="delete_appointments" class="btn btn-danger delete" value="supprimer rendez-vous" />
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>