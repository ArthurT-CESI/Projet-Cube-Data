<?php
    
    include '../../../config/header.php';
    include '../../../config/connect.php';
    /* Requête pour tous les éléments de la collection */
    $query = new MongoDB\Driver\Query( [] );

    /* Interrogez les collections de la base de données "dbCube" */
    $cursorAnnonces = $manager->executeQuery("dbCube.Jeux", $query);

?>
    <nav class="navbar sticky-top navbar-dark bg-dark">
        <div class="container col-6">
            <a class="btn btn-warning" href="admin.php" role="button">Accueil</a>
            <a class="btn btn-warning" href="annonces_a_valider.php" role="button">Annonces en attente</a>
            <a class="btn btn-warning" href="/annonces/annonces.php" role="button">Liste des annonces</a>
            <a class="btn btn-warning" href="/joueurs/joueurs.php" role="button">Liste des joueurs</a>
            <a class="btn btn-warning" href="/jeux/jeux.php" role="button">Liste des jeux</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center">Liste des jeux en attente de validation</h1>
    </div>
    <br>

    <div class="card container">
        <div class="container col"><h3 class="text-uppercase text-center text-dark bg-warning">Jeux</h3></div><br>

        <div class="container">
            <div class="row">
            <?php
            // connexion à la base de données
            $filter = ['valide' => false];
            $options = [];
            $query = new \MongoDB\Driver\Query($filter, $options);
            $cursorJeux = $manager->executeQuery('dbCube.Jeux', $query);

            foreach($cursorJeux as $document) {
                echo '<div class="col-4">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item active">', $document->nomJeu, "<br><br>";
                            echo '<div class="float-right">';
                                echo "<a href='/index/jeux/edit.php?id=".$document->_id."' class='btn btn-warning btn-sm'>Editer</a>";
                                echo "<a href='/index/jeux/delete.php?id=".$document->_id."' class='btn btn-danger btn-sm'>Supprimer</a>";
                                echo "<a href='/index/jeux/validate.php?id=".$document->_id."' class='btn btn-success btn-sm'>Valider</a>";
                            echo '</div>';
                            echo '<li class="list-group-item"><img style="width:388px;height:200px;padding-right:12px;" src=',$document->image,"></img></li>";
                            echo '<li class="list-group-item"> Genre : ', $document->genre, "</li>";
                            echo '<li class="list-group-item"> Pegi : ', $document->pegi, "</li>";
                        echo "</ul><br>";
                        echo '</div>';
            }
            ?>
            </div>
        </div>
    </div>

<?php include '../../../config/footer.php'; ?>
<!--
            <div class="rcol">
                <ul>
                    <li>Nom : <?php echo $nom ?></li>
                    <li>Image : <img src="<?php echo $image ?>"></li>
                    <li>Theme : <?php echo $theme ?></li>
                </ul>
            </div>
-->  