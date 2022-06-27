<?php 
    include '../../../config/header.php';
    include '../../../config/connect.php';
    session_start(); 
?>
    <div class="container" id="content">
        <br>
        <a style="margin-top:0.5%; margin-bottom:5%;" class="btn btn-warning" href="annonceur.php"><span>Retour<br></span></a>
        <br>
        <br>
    </div>    

    <!-- tester si l'utilisateur est connecté -->
    <?php
        if(isset($_GET['deconnexion'])){ 
            if($_GET['deconnexion']==true){
                session_destroy();
                header("location:.");
            }
        }else if(isset($_SESSION['mail'])){   
            $user = $_SESSION['mail'];
            // connexion à la base de données
            $filter = ['mail' => $user];
            $options = [];
            $query = new \MongoDB\Driver\Query($filter, $options);
            $rows   = $manager->executeQuery('dbCube.Annonceurs', $query);

            foreach ($rows as $document) {
                $AnnonceurNom = $document->nom;
                $mail = $document->mail;
                $id = $document->_id;
            }
        }else{
            header("location:../../../index.php");
        }
    ?>  

    <h3 style="margin-top:-5%;" class="text-center">Enregistrez votre annonce : </h3>
    <div style="margin-bottom:-10%;" class="container">
        <div class="card mx-auto">

            <form action="/annonces/createAction.php" method="POST">
                
                <input type="hidden" name="idAnnonceur" value=<?php echo $id ?>>
            
                <div style="margin-top:2%;" class="container mx-auto">
                    <div class="row col-6 offset-3">
                        <label for="nom" class="form-label">Nom de l'annonce</label>
                        <input type="text" name="nom" id="nom" class="form-control">
                    </div>
                </div>
                
                <div style="margin-top:2%;" class="container mx-auto">        
                    <div class="row col-6 offset-3">
                        <label for="Image" name="Image" class="form-label">URL Image</label>
                        <input type="text" id="Image" name="Image" class="form-control">
                    </div>
                </div>

                <div style="margin-top:2%;" class="container mx-auto">        
                    <div class="row col-6 offset-3">
                        <label for="Encheres" name="Encheres" class="form-label">Prix d'enchère (minimum 0,1 €)</label>
                        <input type="number" id="Encheres" name="Encheres" class="form-control" min="0.1" step="0.01">
                    </div>
                </div>

                
                
                <div class="offset-3" role="group">
                    <br>
                    <h5>Choisissez le Pegi de votre Annonce : </h5>

                    <input type="radio" class="btn-check" name="pegi" id="pegi3" value=3>
                    <label class="btn btn-outline-primary" for="pegi3">3+</label>
                    <input type="radio" class="btn-check" name="pegi" id="pegi7" value=7>
                    <label class="btn btn-outline-primary" for="pegi7">7+</label>
                    <input type="radio" class="btn-check" name="pegi" id="pegi12" value=12>
                    <label class="btn btn-outline-primary" for="pegi12">12+</label>
                    <input type="radio" class="btn-check" name="pegi" id="pegi16" value=16>
                    <label class="btn btn-outline-primary" for="pegi16">16+</label>
                    <input type="radio" class="btn-check" name="pegi" id="pegi18" value=18>
                    <label class="btn btn-outline-primary" for="pegi18">18+</label>
                </div>
                
                <div style="margin-bottom:2%;" class="offset-3">
                    <br>
                    <h5>Choisissez le genre de votre annonce : </h5>
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <div style="margin-right:3%;" class="row col-2">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" value="Action" required>
                            <label class="btn btn-outline-primary" for="btnradio1">Action</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" value="Aventure">
                            <label class="btn btn-outline-primary" for="btnradio2">Aventure</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" value="Arcade">
                            <label class="btn btn-outline-primary" for="btnradio3">Arcade</label>
                        
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4" value="Plateau">
                            <label class="btn btn-outline-primary" for="btnradio4">Plateau</label>
                        </div>
                        
                        <div style="margin-right:3%;" class="row col-2">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio5" value="Carte">
                            <label class="btn btn-outline-primary" for="btnradio5">Carte</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio6" value="Casino">
                            <label class="btn btn-outline-primary" for="btnradio6">Casino</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio7" value="Casual">
                            <label class="btn btn-outline-primary" for="btnradio7">Casual</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio8" value="Musique">
                            <label class="btn btn-outline-primary" for="btnradio8">Musique</label>
                        </div>

                        <div style="margin-right:3%;" class="row col-2">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio9" value="Puzzle">
                            <label class="btn btn-outline-primary" for="btnradio9">Puzzle</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio10" value="Course">
                            <label class="btn btn-outline-primary" for="btnradio10">Course</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio11" value="RPG">
                            <label class="btn btn-outline-primary" for="btnradio11">RPG</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio12" value="Simulation">
                            <label class="btn btn-outline-primary" for="btnradio12">Simulation</label>
                        </div>

                        <div style="margin-right:3%;" class="row col-2">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio13" value="Sports">
                            <label class="btn btn-outline-primary" for="btnradio13">Sports</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio14" value="Strategie">
                            <label class="btn btn-outline-primary" for="btnradio14">Strategie</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio15" value="Quiz">
                            <label class="btn btn-outline-primary" for="btnradio15">Quiz</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio16" value="Mots">
                            <label class="btn btn-outline-primary" for="btnradio16">Mots</label>
                        </div>
                    </div>
                    
                    <input style="margin-top:4%;" class="col-8 btn btn-success" name="submit" type="submit" value="Envoyer">

                </div>
            </form>
        </div>
    </div>

<?php include '../../../config/footer.php' ?>