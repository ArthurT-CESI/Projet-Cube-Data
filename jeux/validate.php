<?php

    include '../config/connect.php';
    
    if (isset($_GET['id']) and $_GET['id']<>"") {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])], 
            ['$set' => ['valide' => True]]
        );

        $change = $manager->executeBulkWrite('dbCube.Jeux', $bulk);

        $_SESSION['success'] = "Jeu modifié"; 
        header("Location: /profil/dashboard/admin/jeux_a_valider.php");     
    }
    else{
        echo "Une erreur est survenue, nous n'avons pas pu localiser le jeu <br>";
        echo "<a href='index.php' class='btn btn-primary btn-sm'>Accueil</a>";
    }
?>