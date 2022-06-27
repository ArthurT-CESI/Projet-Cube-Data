<?php
    
    include '../../../config/header.php';
    include '../../../config/connect.php';
    session_start();
    
    /* Requête pour tous les éléments de la collection */
    $query = new MongoDB\Driver\Query( [] );

    /* Interrogez les collections de la base de données "dbCube" */
    $cursorJeux = $manager->executeQuery("dbCube.Jeux", $query);
    $cursorJoueurs = $manager->executeQuery("dbCube.Joueurs", $query);
    $cursorAnnonces = $manager->executeQuery("dbCube.Annonces", $query);

?>

    <nav class="navbar sticky-top navbar-light bg-light">
        <div class="container col-3">
            <a class="btn btn-warning" href="" role="button">Menu</a>
            <a class="btn btn-primary" href="../../../jeux/jeux.php" role="button">Jeux</a>
            <a class="btn btn-primary" href="../../../joueurs/joueurs.php" role="button">Joueurs</a>
            <a class="btn btn-primary" href="../../../annonces/annonces.php" role="button">Annonces</a>
        </div>
    </nav> 

    <div class="container">
        <h1 class="text-center">Liste des collections</h1>
        <h2 class="text-center">Nom de la base de données : dbCube</h2>
    </div>
    
    <br>

    <div class="card container">
        <div class="container col"><h3 class="text-uppercase text-center text-dark bg-warning">Jeux</h3></div><br>

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
                if($collection->name == "Jeux"){
                    foreach($cursorJeux as $document) {
                        echo '<div class="col-4">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item active">', $document->Nom;
                            echo '<div class="float-right">';
                                echo "<a href='/index/jeux/edit.php?id=".$document->_id."' class='btn btn-warning btn-sm'>Edit.</a>";
                                echo "<a href='/index/jeux/delete.php?id=".$document->_id."' class='btn btn-danger btn-sm'>Suppr.</a>";
                            echo '</div>';
                            echo '<li class="list-group-item">', $document->Genre, " (genre) </li>";
                            echo '<li class="list-group-item">', $document->Theme, " (theme) </li>";
                            echo '<li class="list-group-item">', $document->Pegi, " (pegi) </li>";
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
                                echo "<a href='annonces/edit.php?id=".$document->_id."' class='btn btn-warning btn-sm'>Edit.</a>";
                                echo "<a href='annonces/delete.php?id=".$document->_id."' class='btn btn-danger btn-sm'>Suppr.</a>";
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

    <br>
    
    <div class="card container">
        <div class="container col"><h3 class="text-uppercase text-center text-dark bg-warning">Joueurs</h3></div><br> 

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
                if ($collection->name == "Joueurs") {
                    foreach($cursorJoueurs as $document) {
                        echo '<div class="col-4">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item active">', $document->nomJoueur, " ",$document->prenomJoueur;
                            echo '<div class="float-right">';
                                echo "<a href='joueurs/edit.php?id=".$document->_id."' class='btn btn-warning btn-sm'>Edit.</a>";
                                echo "<a href='joueurs/delete.php?id=".$document->_id."' class='btn btn-danger btn-sm'>Suppr.</a>";
                            echo '</div>';
                            echo '<li class="list-group-item">', $document->pseudoJoueur, " (pseudo)</li>";
                            echo '<li class="list-group-item">', $document->age, " ans</li>";
                            echo '<li class="list-group-item">', $document->sexe, " (genre)</li>";
                            echo '<li class="list-group-item">', $document->mail, "</li>";
                            echo '<li class="list-group-item">', $document->preferences, " (préférences de jeux)</li>";
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

<?php include '../../../config/footer.php'; ?>