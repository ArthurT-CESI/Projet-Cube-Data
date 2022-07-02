<?php
    
    include '../config/header.php';
    include '../config/connect.php';
    
    if (isset($_GET['id'])) {
        $options = [];
        $filter = ['_id' => new \MongoDB\BSON\ObjectID($_GET['id'])];
        $query = new \MongoDB\Driver\Query($filter, $options);

        $cursor = $manager->executeQuery('dbCube.Annonces', $query);
        $cursorArray = $cursor->toArray();

        $document = current($cursorArray);
    }
     
    if(isset($_POST['submit'])){ 

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])], 
            ['$set' => ['Nom' => $_POST['Nom'],'AgeMini' => $_POST['AgeMini'],'Theme' => $_POST['Theme'],'Encheres' => $_POST['Encheres']]]
        );

        $change = $manager->executeBulkWrite('dbCube.Annonces', $bulk);
        echo '<div class="alert alert-success">Annonce modifiée !</div>';    
     }

?>

<div class="container">
    <a href="../profil/dashboard/admin/annonces_a_valider.php" class="btn btn-primary">Annonces en attente</a>
    <a href="annonces.php" class="btn btn-primary">Liste des annonces</a>
</div>  

<br>
    <div class="container col-6">
        <h1>Editer l'annonce - <?php echo $document->Nom ?></h1> 
        <form method="POST">

            <br>

            <div class="form-group">
                <label>Nom :</label>
                <input type="text" name="Nom" value="<?php echo $document->Nom ?>" required="" class="form-control" placeholder="<?php echo $document->Nom ?>">
            </div>

            <br>

            <div class="form-group">
                <label>Thème :</label>
                <input type="text" name="Theme" value="<?php echo $document->Theme ?>" required="" class="form-control" placeholder="<?php echo $document->Theme ?>">
            </div>

            <br>

            <div class="form-group">
                <label>Âge minimun :</label>
                <input type="number" name="AgeMini" value="<?php echo $document->AgeMini ?>" required="" class="form-control" placeholder="<?php echo $document->AgeMini ?>">
            </div>

            <br>

            <div class="form-group">
                <label>Enchère :</label>
                <input type="number" step="any" name="Encheres" value="<?php echo $document->Encheres ?>" required="" class="form-control" placeholder="<?php echo $document->Encheres ?>">
            </div>

            <br>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success">Envoyer</button>
            </div>
        </form>
    </div>
</div>