<?php
    
    include '../../../config/header.php';
    include '../../../config/connect.php';
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
            ['$set' => ['nom' => $_POST['nomJeu'], 'genre' => $_POST['btnradio'], 'pegi'=>$_POST['pegi'],'valide'=>false]]
        );

        $change = $manager->executeBulkWrite('dbCube.Jeux', $bulk);

        $_SESSION['success'] = "Jeu modifié";
        header('Location: liste.php');
     }

?>

<div class="container">
    <a href="liste.php" class="btn btn-warning">Retour</a>
</div>    

<br>
     
    <div class="container col-6">
        <h1>Editer le jeu - <?php echo $document->nomJeu ?></h1>
    
        <form method="POST">

            <br>
            <div class="col-4">
            <img src="<?php echo $document->image ?>" class="rounded mx-auto d-block img-fluid"></img>
            </div>
             <br>
            <div class="form-group">
                <label> <b>Nom :</label>
                    <br>
                    <br>
                <input type="text" name="nomJeu" value="<?php echo $document->nomJeu ?>" required="" class="form-control" placeholder="<?php echo $document->nomJeu ?>">
            </div>

            <br>

            <label> <b>Genre :</label><br><br>
                
                <div >
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <div style="margin-right:3%;" class="row col-2">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="Action" required <?php if($document->genre=="Action"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio1">Action</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="Aventure" <?php if($document->genre=="Aventure"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio2">Aventure</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" value="Arcade" <?php if($document->genre=="Arcade"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio3">Arcade</label>
                        
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4" value="Plateau" <?php if($document->genre=="Plateau"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio4">Plateau</label>
                        </div>
                        
                        <div style="margin-right:3%;" class="row col-2">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio5" value="Carte" <?php if($document->genre=="Carte"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio5">Carte</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio6" value="Casino" <?php if($document->genre=="Casino"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio6">Casino</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio7" value="Casual" <?php if($document->genre=="Casual"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio7">Casual</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio8" value="Musique" <?php if($document->genre=="Musique"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio8">Musique</label>
                        </div>

                        <div style="margin-right:3%;" class="row col-2">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio9" value="Puzzle" <?php if($document->genre=="Puzzle"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio9">Puzzle</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio10" value="Course" <?php if($document->genre=="Course"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio10">Course</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio11" value="RPG" <?php if($document->genre=="RPG"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio11">RPG</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio12" value="Simulation" <?php if($document->genre=="Simulation"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio12">Simulation</label>
                        </div>

                        <div style="margin-right:3%;" class="row col-2">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio13" value="Sports" <?php if($document->genre=="Sports"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio13">Sports</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio14" value="Strategie" <?php if($document->genre=="Strategie"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio14">Strategie</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio15" value="Quiz" <?php if($document->genre=="Quiz"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio15">Quiz</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio16" value="Mots" <?php if($document->genre=="Mots"){ echo "checked"; }?>>
                            <label class="btn btn-outline-primary" for="btnradio16">Mots</label>
                        </div>
                    </div>

                </div>

            <br>

            <br>
            <label><b>Pegi :</label>
            <br>
            <br>
            <div class="" role="group">
                    <input type="radio" class="btn-check" name="pegi" id="pegi3" value=3 required <?php if($document->pegi==3){ echo "checked"; }?>>
                    <label class="btn btn-outline-primary" for="pegi3">3+</label>
                    <input type="radio" class="btn-check" name="pegi" id="pegi7" value=7 <?php if($document->pegi==7){ echo "checked"; }?>>
                    <label class="btn btn-outline-primary" for="pegi7">7+</label>
                    <input type="radio" class="btn-check" name="pegi" id="pegi12" value=12 <?php if($document->pegi==12){ echo "checked"; }?>>
                    <label class="btn btn-outline-primary" for="pegi12">12+</label>
                    <input type="radio" class="btn-check" name="pegi" id="pegi16" value=16 <?php if($document->pegi==16){ echo "checked"; }?>>
                    <label class="btn btn-outline-primary" for="pegi16">16+</label>
                    <input type="radio" class="btn-check" name="pegi" id="pegi18" value=18 <?php if($document->pegi==18){ echo "checked"; }?>>
                    <label class="btn btn-outline-primary" for="pegi18">18+</label>
                </div>

            <br>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success">Modifier</button>
            </div>

        </form>
    </div>
</div>