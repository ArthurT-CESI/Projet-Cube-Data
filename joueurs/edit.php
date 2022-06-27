<?php
    
    include '../config/header.php';
    include '../config/connect.php';
    session_start();

    if (isset($_GET['id'])) {
        $options = [];
        $filter = ['_id' => new \MongoDB\BSON\ObjectID($_GET['id'])];
        $query = new \MongoDB\Driver\Query($filter, $options);

        $cursor = $manager->executeQuery('dbCube.Joueurs', $query);
        $cursorArray = $cursor->toArray();

        $document = current($cursorArray);
    }
     
    if(isset($_POST['submit'])){ 

        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])], 
            ['$set' => ['nomJoueur' => $_POST['nomJoueur'],'prenomJoueur' => $_POST['prenomJoueur'],'pseudoJoueur' => $_POST['pseudoJoueur'],'sexe' => $_POST['sexe'],'age' => $_POST['age'],'mail' => $_POST['mail'],'preferences' => $_POST['preferences']]]
        );

        $change = $manager->executeBulkWrite('dbCube.Joueurs', $bulk);

        $_SESSION['success'] = "Joueur modifié";
        header("Location: joueurs.php");     
     }

?>

<div class="container">
    <a href="joueurs.php" class="btn btn-primary">Retour</a>
</div>    

<br>
     
    <div class="container col-6">
        <h1>Editer le/la joueur(euse) - <?php echo $document->nomJoueur, " ", $document->prenomJoueur , " (", $document->pseudoJoueur, ")" ?></h1>
    
        <form method="POST">

            <br>

            <div class="form-group">
                <label>Nom :</label>
                <input type="text" name="nomJoueur" value="<?php echo $document->nomJoueur ?>" required="" class="form-control" placeholder="<?php echo $document->nomJoueur ?>">
            </div>

            <br>

            <div class="form-group">
                <label>Prénom :</label>
                <input type="text" name="prenomJoueur" value="<?php echo $document->prenomJoueur ?>" required="" class="form-control" placeholder="<?php echo $document->prenomJoueur ?>">
            </div>

            <br>

            <div class="form-group">
                <label>Pseudo :</label>
                <input type="text" name="pseudoJoueur" value="<?php echo $document->pseudoJoueur ?>" required="" class="form-control" placeholder="<?php echo $document->pseudoJoueur ?>">
            </div>

            <br>

            <div class="form-group">
                <label>Âge (chiffres) :</label>
                <input type="number" name="age" value="<?php echo $document->age ?>" required="" class="form-control" placeholder="<?php echo $document->age ?>">
            </div>

            <br>

            <div class="form-group">
                <label>Genre (<?php echo $document->sexe ?>) : </label>
                <input type="radio" name="sexe" value="Homme" required>Homme
                <input type="radio" name="sexe" value="Femme">Femme
            </div>
            
                <br>

            <div class="form-group">
                <label>Mail :</label>
                <input type="email" name="mail" value="<?php echo $document->mail ?>" required="" class="form-control" placeholder="<?php echo $document->mail ?>">
            </div>

            <br>

            <div class="form-group">
                <label>Préférences (Séparer avec des virgules) :</label>
                <input type="text" name="preferences" value="<?php echo $document->preferences ?>" required="" class="form-control" placeholder="<?php echo $document->preferences ?>">
            </div>

            <br>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success">Envoyer</button>
            </div>

        </form>
    </div>
</div>