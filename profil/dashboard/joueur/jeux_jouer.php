<?php

    include '../../../config/header.php';
    include '../../../config/connect.php';
    session_start();
    /* Requête pour tous les éléments de la collection */
    $query = new MongoDB\Driver\Query( [] );

    /* Interrogez les collections de la base de données "dbCube" */
    $cursorAnnonces = $manager->executeQuery("dbCube.Jeux", $query);

?>
    <nav class="navbar sticky-top navbar-dark bg-dark">
        <div class="container col-6">
            <a class="btn btn-warning" href="joueur.php" role="button">Accueil</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center">Choississez votre jeu</h1>
    </div>
    <br>

    <div class="card container">
        <div class="container col"><h3 class="text-uppercase text-center text-dark bg-warning">Jeux</h3></div><br>

        <div class="container">
            <div class="row">
            <?php
            // connexion à la base de données
            $filter = ['valide' => true];
            $options = ['sort' => ['nomJeu' => 1],'limit' => 50]; #'limit' => 50,
            $query = new \MongoDB\Driver\Query($filter, $options);
            $cursorJeux = $manager->executeQuery('dbCube.Jeux', $query);

            foreach($cursorJeux as $document) {
                echo '<div class="col-4">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item active text-center">', $document->nomJeu, "<br><br>";
                            echo '<div class="float-right">';
                            echo "<a href='jouer.php?id=".$document->_id."' class='btn btn-success btn-sm col-3'>Jouer !</a>";
                            echo '</div>';
                            echo '<li class="list-group-item text-center"><img style="width:300px;height:300px;" src=',$document->image,"></img></li>";
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