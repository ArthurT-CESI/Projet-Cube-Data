<?php
    
    include '../../../config/header.php';
    include '../../../config/connect.php';
    session_start();

    
    if (isset($_GET['id'])) {
        $options = [];
        $filter = ['_id' => new \MongoDB\BSON\ObjectID($_GET['id'])];
        $query = new \MongoDB\Driver\Query($filter, $options);

        $cursor = $manager->executeQuery('dbCube.Annonces', $query);
        $cursorArray = $cursor->toArray();

        $document = current($cursorArray);
    }
     
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);

    $change = $manager->executeBulkWrite('dbCube.Annonces', $bulk);

    $_SESSION['success'] = "Annonce supprimée";
    header("Location: liste.php");     

?>