<?php
    
    include '../../../config/header.php';
    include '../../../config/connect.php';
    /* Requête pour tous les éléments de la collection */
    $query = new MongoDB\Driver\Query( [] );

    /* Interrogez les collections de la base de données "dbCube" */
    $cursorAnnonces = $manager->executeQuery("dbCube.Annonces", $query);

?>
    <nav class="navbar sticky-top navbar-dark bg-dark">
        <div class="container col-6">
            <a class="btn btn-warning" href="admin.php" role="button">Accueil</a>
            <a class="btn btn-warning" href="jeux_a_valider.php" role="button">Jeux en attente</a>
            <a class="btn btn-warning" href="/annonces/annonces.php" role="button">Liste des annonces</a>
            <a class="btn btn-warning" href="/joueurs/joueurs.php" role="button">Liste des joueurs</a>
            <a class="btn btn-warning" href="/jeux/jeux.php" role="button">Liste des jeux</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center">Liste des annonces en attente de validation</h1>
    </div>
    <br>

    <div class="card container">
        <div class="container col"><h3 class="text-uppercase text-center text-dark bg-warning">Annonces</h3></div><br>

        <div class="container">
            <div class="row">
            <?php
            // connexion à la base de données
            $filter = ['Valide' => false];
            $options = [];
            $query = new \MongoDB\Driver\Query($filter, $options);
            $cursorAnnonces = $manager->executeQuery('dbCube.Annonces', $query);

            foreach($cursorAnnonces as $document) {
                echo '<div class="col-4">';
                echo '<ul class="list-group">';
                    echo '<li class="list-group-item active text-center">', $document->Nom, "<br><br>";
                    echo '<div >';
                            echo "<a href='/index/annonces/edit.php?id=".$document->_id."' class='btn btn-warning btn-sm col-3'>Editer</a>";
                            echo "<a style='margin-left:1%; margin-right:1%' href='/index/annonces/delete.php?id=".$document->_id."' class='btn btn-danger btn-sm col-3'>Suppr.</a>";
                            echo "<a href='/index/annonces/validate.php?id=".$document->_id."' class='btn btn-success btn-sm col-3'>Valider</a>";
                        echo '</div>';
                        echo '<li class="list-group-item"><img style="width:388px;height:200px;padding-right:12px;" src=',$document->Image,"></img></li>";
                        echo '<li class="list-group-item"> Theme : ', $document->Theme, "</li>";
                        echo '<li class="list-group-item"> Pegi : ', $document->AgeMini, "</li>";
                        if(property_exists($document,"Encheres")){
                             if(isset($document->Encheres)){
                                echo '<li class="list-group-item"> Prix enchère : ', $document->Encheres, "€</li>";
                            }
                        }
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