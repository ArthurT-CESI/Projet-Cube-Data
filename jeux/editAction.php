<?php

    include '../config/connect.php';
    session_start();

    if(isset($_POST['submit'])){ 

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            ['_id' => new MongoDB\BSON\ObjectID($_POST['id'])], 
            ['$set' => ['nom' => $_POST['nomJeu'], 'genre' => $_POST['genre'], 'pegi'=>$_POST['pegi']]]
        );

        $change = $manager->executeBulkWrite('dbCube.Jeux', $bulk);

        $_SESSION['success'] = "Jeu modifié";

        echo '<script>javascript:history.go(-2)</script>';

    }
?>