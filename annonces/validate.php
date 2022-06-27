<?php
    
    include '../config/header.php';
    include '../config/connect.php';
    
    if (isset($_GET['id']) and $_GET['id']<>"") {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])], 
            ['$set' => ['Valide' => True]]
        );

        $change = $manager->executeBulkWrite('dbCube.Annonces', $bulk);

        $_SESSION['success'] = "Annonce modifiée"; 
        header("Location: /index/profil/dashboard/admin/annonces_a_valider.php");     
    }
    else{
        echo "Une erreur est survenue, nous n'avons pas pu localiser l'annonce <br>";
        echo "<a href='/index/index.php' class='btn btn-primary btn-sm'>Accueil</a>";
    }
?>