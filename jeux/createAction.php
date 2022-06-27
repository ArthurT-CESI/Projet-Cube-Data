<?php

    include '../config/connect.php';
    session_start();

    if (isset($_POST['submit'])) {

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk -> insert(['_id' => new MongoDB\BSON\ObjectID,
         'nomJeu' => $_POST['nom'],
         'genre' => $_POST["btnradio"], 
         'id_editeur' => new MongoDB\BSON\ObjectID($_POST["idEdit"]), 
         'pegi' => (int)$_POST["pegi"],
         'valide' => FALSE,
         'image' => $_POST["Image"],
         'imageJeu' => "/images/no_image.gif"    
        ]);

        $change = $manager->executeBulkWrite('dbCube.Jeux', $bulk);
        
        header("location:../../../index.php");
        
    }
?>

