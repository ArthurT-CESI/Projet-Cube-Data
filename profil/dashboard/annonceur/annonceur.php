<?php 
    include '../../../config/header.php';
    include '../../../config/connect.php';
    session_start(); 
?>

<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body style='background:#000;'>
        <div class="container" id="content">
            <br>
            <a class="btn btn-warning" href='/config/deconnexion.php'><span>Déconnexion<br></span></a>
            <br>
            <br>
        </div>
        <div class="container" id="content" style='background:#fff;margin-left: auto;margin-right: auto;width: 80%'>
            
            
            <!-- tester si l'utilisateur est connecté -->
            <?php
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_unset();
                      header("location:../../../index.php");
                   }
                }
                else if(isset($_SESSION['mail'])){   
                    $user = $_SESSION['mail'];
                    // connexion à la base de données
                    $filter = ['mail' => $user];
                    $options = [];
                    $query = new \MongoDB\Driver\Query($filter, $options);
                    $cursor   = $manager->executeQuery('dbCube.Annonceurs', $query);
                    $cursorArray = $cursor->toArray();
                    $document = current($cursorArray);
                ?>

                    <br>
                    <div class="rcol">
                    <img style="width:500px;height:300px;" src="<?php if(isset($document->logo)) {echo $document->logo;} else { echo '/images/exemple.jpg';} ?>"></img>
                    <p>Bienvenue dans votre espace Annonceur</p>
                    <ul>
                    <li>Nom : <?php echo $document->nom ?></li>
                    <li>Site : <?php echo $document->site ?></li>
                    <li>Categorie : <?php echo $document->categorie ?></li>
                    <li>Pays : <?php echo $document->pays ?></li>
                    </ul>
                    </div>
                <?php
                }
                else{
                    header("location:../../../index.php");
                }
            ?>

            <div class="container">
                <a class="btn btn-warning" href='pilotage.php'>Pilotage des activités<br></a>
                <a href="inscription.php" class="btn btn-warning">Ajouter une annonce</a>
                <a href="liste.php" class="btn btn-warning">Mes annonces</a>
            </div>
            <br>
              
        </div>
        

<?php include '../../../config/footer.php' ?>