<?php
    
    include '../config/header.php';
    include '../config/connect.php';
    session_start();

    if (isset($_GET['id'])) {
        $options = [];
        $filter = ['_id' => new \MongoDB\BSON\ObjectID($_GET['id'])];
        $query = new \MongoDB\Driver\Query($filter, $options);

        $cursor = $manager->executeQuery('dbCube.Jeux', $query);
        $cursorArray = $cursor->toArray();

        $document = current($cursorArray);
    }
     
    if(isset($_POST['submit'])){ 

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])], 
            ['$set' => ['nom' => $_POST['nomJeu'], 'genre' => $_POST['genre'], 'pegi'=>$_POST['pegi']]]
        );

        $change = $manager->executeBulkWrite('dbCube.Jeux', $bulk);

        $_SESSION['success'] = "Jeu modifié";
     }

?>

<div class="container">
    <a href="jeux.php" class="btn btn-primary">Retour</a>
</div>    

<br>
     
    <div class="container col-6">
        <h1>Editer le jeu - <?php echo $document->nomJeu ?></h1>
    
        <form method="POST">

            <br>    
    
            <div class="form-group">
                <label>Nom :</label>
                <input type="text" name="nomJeu" value="<?php echo $document->nomJeu ?>" required="" class="form-control" placeholder="<?php echo $document->nomJeu ?>">
            </div>

            <br>

            <div class="form-group">
                <label>Genre :</label>
                <input type="text" name="genre" value="<?php echo $document->genre ?>" required="" class="form-control" placeholder="<?php echo $document->genre ?>">
            </div>

            <br>

            <br>

            <div class="form-group">
                <label>Âge minimun :</label>
                <input type="number" name="pegi" value="<?php echo $document->pegi ?>" required="" class="form-control" placeholder="<?php echo $document->pegi ?>">
            </div>

            <br>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success">Envoyer</button>
            </div>

        </form>
    </div>
</div>