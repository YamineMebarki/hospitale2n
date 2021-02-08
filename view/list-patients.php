<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center font-style">Liste des patients :</h1>
            <nav aria-label = "Page navigation example">
                <ul class = "pagination">
                    <?php
                    for ($i = 1; $i <= $page; $i++) :
                        isset($_GET['page']) ? $_GET['page'] : $_GET['page'] = 1;
                        if ($_GET['page'] != $i):
                            ?>
                            <li class="page-item"><a class="page-link" href="index.php?list_patients&page=<?= $i ?>"><?= $i ?></a></li>
                        <?php else : ?>
                            <li class="page-item page-link text-disabled text-danger"><?= $i ?></li>
                            <?php
                        endif;
                    endfor;
                    ?>
                </ul>
            </nav>
            <form action="" method="POST" class="form-group text-center">
                <div class="form-group"><label class="font-style" for="query">Recherche :
                        <input type="text" name="query" id="query" class="form-control" >
                    </label>
                    <input type="submit" name="search" id="query" class="btn btn-sm btn-success" value="rechercher">
                </div>
            </form>
            <h2 class="text-center text-danger"><?= isset($erreur['query']) ? $erreur['query'] : '' ?></h2>
            <hr/>
            <table class="table-hover table-responsive center table">
                <thead>
                <tr>
                    <th class="table-success">NOM</th>
                    <th class="table-success">PRENOM</th>
                    <th class="table-success">PROFIL</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($patientsList as $patient): ?>
                    <tr>
                        <td class="table-success" data-label="NOM"><?= $patient->lastname ?></td>
                        <td class="table-success" data-label="PRENOM"><?= $patient->firstname ?></td>
                        <td class="table-success" data-label="PROFIL">
                            <a href="index.php?profil_patient&id=<?= $patient->id ?>" class="text-black-50">
                                <span class="h6">en savoir plus</span>
                            </a>
                        </td>
                        <td class="text-center table-success">
                            <form action="" method="POST">
                                <input type="hidden" name="id_patient" value="<?= $patient->id ?>">
                                <input type="submit" name="delete_patient" class="btn btn-danger mt-2 mb-2" value="supprimer profil" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
