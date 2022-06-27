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
        <div id="container" style='background:#fff;margin-left: auto;margin-right: auto;width: 80%'> 
            <!-- tester si l'utilisateur est connecté -->
            <?php
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_destroy();
                      header("location:.");
                   }
                }
                else if(isset($_SESSION['mail'])){   
                    $user = $_SESSION['mail'];
                    // connexion à la base de données
                    $filter = ['mail' => $user];
                    $options = [];
                    $query = new \MongoDB\Driver\Query($filter, $options);
                    $rows   = $manager->executeQuery('dbCube.Joueurs', $query);

                    foreach ($rows as $document) {
                        $pseudo = $document->pseudoJoueur;
                        $nom = $document->nomJoueur;
                        $mail = $document->mail;
                        $prenom = $document->prenomJoueur;
                        $age = $document->age;
                        $preferences = $document->preferences;
                    }
                ?>

                    <br>
                    <div class="container">
                    <p>Bonjour <?php echo $pseudo ?>, bienvenue dans votre espace joueur</p>
                    <ul>
                    <li>Nom : <?php echo $nom ?></li>
                    <li>Prénom : <?php echo $prenom ?></li>
                    <li>Age : <?php echo $age ?></li>
                    <li>Mail : <?php echo $mail ?></li>
                    <li>Preferences : <?php echo $preferences ?></li>
                    </ul>
                    </div>

                    <br>
                    <div class="container">
                        <h2>Espace jeu</h2>
                        <br>
                        <a class="btn btn-warning" href='jeux_jouer.php'><span>Jouer à un jeu !<br></span></a>
                    </div>
                    <br>

                <?php
                }
                else{
                    header("location:../../../index.php");
                }
            ?>
              
        </div>

<?php include '../../../config/footer.php' ?>