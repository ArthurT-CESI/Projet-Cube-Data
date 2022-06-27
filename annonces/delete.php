<?php
    
    include '../config/header.php';
    include '../config/connect.php';
     
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

    $change = $manager->executeBulkWrite('dbCube.Annonces', $bulk);

    $_SESSION['success'] = "Annonce supprimée";
    header("Location: annonces.php");     

?>