<?php 
    include '../../../config/header.php';
    include '../../../config/connect.php';
    session_start(); 

    if(isset($_SESSION['success'])) {
        if($_SESSION['success'] == "Annonce modifiée"){
            echo "<script>alert(\"L'annonce a été modifiée\")</script>";
            $_SESSION['success'] = "";
        } elseif ($_SESSION['success'] == "Annonce supprimée") {
            echo "<script>alert(\"L'annonce a été supprimée\")</script>";
            $_SESSION['success'] = "";
        }
    }
?>
    
    <div class="container" id="content">
        <br>
        <a style="margin-top:0.5%; margin-bottom:5%;" class="btn btn-warning" href="annonceur.php"><span>Retour<br></span></a>
        <br>
        <br>
    </div>   
 

    <img style="width:10%;height:30%;margin-bottom:1%;margin-top:-7%;" src="/images/Petites-Annonces.jpg" class="img-fluid rounded mx-auto d-block" alt="Image_Annonceur">

    <div class="card container">
        <div class="container col"><h3 class="text-uppercase text-center text-dark bg-warning">Mes annonces</h3></div><br>

        <div class="container">
            <div class="row">

                <!-- tester si l'utilisateur est connecté -->
                <?php
                    if(isset($_GET['deconnexion'])){ 
                        if($_GET['deconnexion']==true){
                            session_destroy();
                            header("location:.");
                        }
                    }else if(isset($_SESSION['mail'])){   
                        $mail = $_SESSION['mail'];
                        // connexion à la base de données
                        $filter = ['mail' => $mail];
                        $options = [];
                        $query = new \MongoDB\Driver\Query($filter, $options);
                        $rows = $manager->executeQuery('dbCube.Annonceurs', $query);
                        
                        foreach($rows as $document) {
                            if ($document->mail == $_SESSION['mail']) {
                                $nomAnnonceur = $document->nom;
                                $filterAnnonce = ['Id_annonceur' => $document->_id];
                                $queryAnnonce = new \MongoDB\Driver\Query($filterAnnonce, $options);
                                $rowsAnnonce = $manager->executeQuery('dbCube.Annonces', $queryAnnonce);
                                
                                foreach ($rowsAnnonce as $docAnnonce) {
                                    $nomAnnonce = $docAnnonce->Nom;
                                    $pegi = $docAnnonce->AgeMini;
                                    $genre = $docAnnonce->Theme;
                                    $valide = $docAnnonce->Valide;
                                    $image = $docAnnonce->Image;

                                    if ($valide == 1) {
                                        $verif = "Valide";
                                    } else {
                                        $verif = "Non valide";
                                    }
                                    
                                    echo '<div class="col-4">';
                                    echo '<ul class="list-group">';
                                        echo '<li class="list-group-item active text-center">', $nomAnnonce;
                                        echo '<div style="margin-top:2%;" class="float-right">';
                                            echo "<a href='edit.php?id=".$docAnnonce->_id."' class='btn btn-warning btn-sm'>Edit.</a>";
                                            echo "<a href='delete.php?id=".$docAnnonce->_id."' class='btn btn-danger btn-sm'>Suppr.</a>";
                                        echo '</div>';
                                        echo '<li class="list-group-item"><img src="' .$image. '" class="rounded mx-auto d-block img-fluid"></img></li>';
                                        echo '<li class="list-group-item"> Genre : ', $genre , "</li>";
                                        echo '<li class="list-group-item"> Pegi : ', $pegi , "</li>";
                                        echo '<li class="list-group-item"> Validé ? : ', $verif,"</li>";
                                    echo "</ul><br>";
                                    echo '</div>';
                                }   
                            }
                        }

                    }else{
                        header("location:../../../index.php");
                    }
                ?>     
            </div>
        </div>
    </div>
</div>

        
</html>
<?php include '../../../config/footer.php' ?>