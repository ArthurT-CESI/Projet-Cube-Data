<?php
    
    include '../config/header.php';
    include '../config/connect.php';
    session_start();

    /* Requête pour tous les éléments de la collection */
    $query = new MongoDB\Driver\Query( [] );

    /* Interrogez la collection "Annonces" de la base de données "dbCube" */
    $cursorAnnonces = $manager->executeQuery("dbCube.Annonces", $query);

?>
    <nav class="navbar sticky-top navbar-dark bg-dark">
        <div class="container col-6">
            <a class="btn btn-warning" href="/profil/dashboard/admin/admin.php" role="button">Accueil</a>
            <a class="btn btn-warning" href="/profil/dashboard/admin/annonces_a_valider" role="button">Annonces en attente</a>
            <a class="btn btn-warning" href="/profil/dashboard/admin/jeux_a_valider.php" role="button">Jeux en attente</a>
            <a class="btn btn-warning" href="/joueurs/joueurs.php" role="button">Liste des joueurs</a>
            <a class="btn btn-warning" href="/jeux/jeux.php" role="button">Liste des jeux</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center">Liste des annonces</h1>
    </div>

    <br>

    <div class="card container">
        <div class="container col"><h3 class="text-uppercase text-center text-dark bg-warning">Annonces</h3></div><br>

        <div class="container">
            <div class="row">

<?php
    // Prendre que la Database dbCube
    foreach ($databases->databases as $database) {
        if($database->name == "dbCube"){

            // Construct and execute the listCollections command for each database
            $listcollections = new MongoDB\Driver\Command(["listCollections" => 1]);
            $result = $manager->executeCommand($database->name, $listcollections);
            /* the command returns a cursor, which we can iterate on to access
            * information for each collection. */
            $collections = $result->toArray();
          
            foreach ($collections as $collection) {
                if ($collection->name == "Annonces") {
                    foreach($cursorAnnonces as $document) {
                        echo '<div class="col-4">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item active">', $document->Nom;
                            echo '<div class="float-right">';
                                echo "<a href='edit.php?id=".$document->_id."' class='btn btn-warning btn-sm'>Edit.</a>";
                                echo "<a href='delete.php?id=".$document->_id."' class='btn btn-danger btn-sm'>Suppr.</a>";
                            echo '</div>';
                            echo '<li class="list-group-item">', $document->Theme, " (theme) </li>";
                            echo '<li class="list-group-item">', $document->AgeMini, " (age minimum) </li>";
                            if(property_exists($document,"Encheres")){
                                if(isset($document->Encheres)){
                                    echo '<li class="list-group-item">', $document->Encheres, " (enchère) </li>";
                                }
                            }
                        echo "</ul><br>";
                        echo '</div>';
                    }
                }
            }
        }
    }
?>

            </div>
        </div>
    </div>

<?php include '../config/footer.php'; ?>