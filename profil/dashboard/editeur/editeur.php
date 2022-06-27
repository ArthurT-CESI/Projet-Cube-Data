<?php 
    include '../../../config/header.php';
    include '../../../config/connect.php';
    session_start(); 
?>
        <div class="container" id="content">
            <br>
            <a class="btn btn-warning" href='/config/deconnexion.php'><span>Déconnexion<br></span></a>
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
            $rows   = $manager->executeQuery('dbCube.Editeurs', $query);

            foreach ($rows as $document) {
                $editeurNom = $document->editeurNom;
                $mail = $document->mail;
            }
        }else{
            header("location:../../../index.php");
        }
    ?>     
    
    <div style="padding-top:10%;" class="container">
        <div class="row justify-content-md-center">
            <div class="col-8">
                <div class="card text-center">
                    <div class="card-header">Tableau de bord : <?php echo $document->editeurNom ?></div>
                    <div class="card-body">
                        <img style="padding-bottom:1%;" src="data:image/png;base64,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" class="img-fluid rounded mx-auto d-block" alt="Image_Editeur">
                        <a href="pilotage.php" class="btn btn-warning">Pilotage</a>
                        <a href="inscription.php" class="btn btn-warning">Inscription</a>
                        <a href="liste.php" class="btn btn-warning">Liste jeux</a>
                    </div>
                    <div class="card-footer text-muted"><?php echo $document->editeurNom ?></div>
                </div>
            </div>
        </div>
    </div>

<?php include '../../../config/footer.php' ?>