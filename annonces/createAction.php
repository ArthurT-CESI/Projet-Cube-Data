<?php

    include '../config/connect.php';
    session_start();

    if (isset($_POST['submit'])) {

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk -> insert(['_id' => new MongoDB\BSON\ObjectID,
         'Nom' => $_POST['nom'],
         'Theme' => $_POST["btnradio"], 
         'Id_annonceur' => new MongoDB\BSON\ObjectID($_POST["idAnnonceur"]), 
         'AgeMini' => (int)$_POST["pegi"],
         'Valide' => FALSE,
         'Image' => $_POST["Image"],
         'NbClics' => 0,
         'Encheres' => (float)$_POST["Encheres"]
        ]);

        $change = $manager->executeBulkWrite('dbCube.Annonces', $bulk);
        
        header("location:/profil/dashboard/annonceur/annonceur.php");
        
    }
?>

