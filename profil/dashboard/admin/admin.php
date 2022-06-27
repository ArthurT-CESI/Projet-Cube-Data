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
        <div class="container">
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
                    $rows   = $manager->executeQuery('dbCube.Admins', $query);

                    foreach ($rows as $document) {
                        $prenom = $document->prenomAdmin;
                        $nom = $document->nomAdmin;
                        $mail = $document->mail;
                        $age = $document->age;
                    }
                ?>
                    <div class="rcol">
                    <br>
                    <p>Bonjour <?php echo $prenom ?>, bienvenue dans votre espace administrateur</p>
                    <ul>
                    <li>Nom : <?php echo $nom ?></li>
                    <li>Prénom : <?php echo $prenom ?></li>
                    <li>Age : <?php echo $age ?> ans</li>
                    <li>Mail : <?php echo $mail ?></li>
                    </ul>
                    </div>
                <?php
                }
                else{
                    header("location:../../../index.php");
                }
            ?>     
        </div>
        <br>
        <div class="container">
            <h2>Validation</h2>
            <a class="btn btn-warning" href='inscription_admin.php'><span>Ajouter un administrateur<br></span></a>
            <a class="btn btn-warning" href='annonces_a_valider.php'><span>Annonces en attente<br></span></a>
            <a class="btn btn-warning" href='jeux_a_valider.php'><span>Jeux en attente<br></span></a>
        </div>
        <br>
        <div class="container">
            <h2>Parcourir</h2>
            <a class="btn btn-warning" href="/annonces/annonces.php" role="button">Liste des annonces</a>
            <a class="btn btn-warning" href="/jeux/jeux.php" role="button">Liste des jeux</a>
            <a class="btn btn-warning" href="/joueurs/joueurs.php" role="button">Liste des joueurs</a>
        </div>
        <br>
        <div class="container">
            <h2>Pilotage des activités</h2>
            <a class="btn btn-warning" href="pilotage_annonces.php" role="button">Suivi des annonces</a>
            <a class="btn btn-warning" href="pilotage_jeux.php" role="button">Suivi des jeux</a>
            <a class="btn btn-warning" href="pilotage_joueurs.php" role="button">Suivi des joueurs</a>
        </div>
        <br>
        <br>
    </div>
    </body>
</html>
<?php include '../../../config/footer.php' ?>

<!--
<iframe style="width:100%;height:100%;background: #F1F5F4;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);"  src="https://charts.mongodb.com/charts-cubedata-fqqfo/embed/dashboards?id=624aeb89-2100-4bcc-808e-273025036bc6&theme=light&autoRefresh=true&maxDataAge=10&showTitleAndDesc=false&scalingWidth=fixed&scalingHeight=fixed"></iframe>
-->