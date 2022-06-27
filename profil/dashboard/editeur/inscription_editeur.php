<?php

    session_start();
    include '../../../config/header.php';
    include '../../../config/connect.php';

    // Si la variable "$_Post" contient des informations alors on les traites
    if(!empty($_POST)){
        extract($_POST);
        $valid = true;

        // On se place sur le bon formulaire grâce au "name" de la balise "input"
        if (isset($_POST['inscription'])){
            $mail = htmlentities(trim($mail)); // On récupère le mail
            $nom = htmlentities(trim($nom)); // On récupère le nom 
            $mdp = htmlentities(trim($mdp)); // On récupère le mot de passe 
            $confmdp = htmlentities(trim($confmdp)); //  On récupère la confirmation du mot de passe

            //  Vérification du nom
            if(empty($nom)){
                $valid = false;
                $er_nom = ("Le nom d' utilisateur ne peut pas être vide");
            }       

            // Vérification du mail
            if(empty($mail)){
                $valid = false;
                $er_mail = "Le mail ne peut pas être vide";
            // On vérifie que le mail est dans le bon format
            }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)){
                $valid = false;
                $er_mail = "Le mail n'est pas valide";
            }else{
                // On vérifie que le mail est disponible
                $filter = ['mail' => $mail];
                $options = [];
                $query = new \MongoDB\Driver\Query($filter, $options);
                
                $rows   = $manager->executeQuery('dbCube.Editeurs', $query);
                $req_mail = "";

                foreach ($rows as $document) {
                        $req_mail = $document->mail;
                    }

                if ($req_mail <> ""){
                    $valid = false;
                    $er_mail = "Ce mail existe déjà : $mail <br>";
                }
            }

            // Vérification du mot de passe
            if(empty($mdp)) {
                $valid = false;
                $er_mdp = "Le mot de passe ne peut pas être vide";
            }elseif($mdp != $confmdp){
                $valid = false;
                $er_mdp = "La confirmation du mot de passe ne correspond pas";
            }

            // Si toutes les conditions sont remplies alors on fait le traitement
            if($valid){
                #$mdp = crypt($mdp, "$6$rounds=5000$macleapersonnaliseretagardersecret$");
                $date_creation_compte = date('Y-m-d H:i:s');

                // On insert nos données dans la table utilisateur
                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk -> insert(['_id' => new MongoDB\BSON\ObjectID,
                 'mail' => $mail,
                 'editeurNom' => $nom,
                 'password' => $mdp,
                 'dateDeCreation' => $date_creation_compte
                ]);

                $change = $manager->executeBulkWrite('dbCube.Editeurs', $bulk);
                header('Location: ../editeur/editeur.php');
                exit;
            }
        }
    }
?>

<html>
    <head>
        <meta charset="utf-8">
            <!-- importer le fichier de style -->
            <link rel="stylesheet" href="../../../styles/style.css" media="screen" type="text/css" />
    </head>

    <body>
                    
        <div class="container">
            <a href="../../../index.php" class="btn btn-warning">Retour</a>
        </div>
            
        <div class="container" style="text-align: center;">
            <h1 style="color: white">Inscription Éditeur</h1>
        </div>

        <div class="container">
            <form id="formulaire" method="post">
                <div class="col-md-3 mb-3">
                    <label for="validationTooltip"><b>Nom</label>
                    <input class="form-control" type="text" placeholder="Votre nom" name="nom" value="<?php if(isset($nom)){ echo $nom; }?>" required> 
                
                <?php
                    // S'il y a une erreur sur le nom alors on affiche
                    if (isset($er_nom)){
                ?>
                    <div style='color:red'><?= $er_nom ?></div>
                    
                <?php   
                    }
                ?>  
        
                </div>
                <br>


                <div class="col-md-3 mb-3">
                    <label for="validationTooltip">Adresse mail</label>
                    <input class="form-control" type="email" placeholder="Adresse mail" name="mail" value="<?php if(isset($mail)){ echo $mail; }?>" required>
                    <?php
                        if (isset($er_mail)){
                    ?>
                            <div style='color:red'><?= $er_mail ?></div>
                    <?php   
                        }
                    ?>
                </div>

                <br>

                <div class="col-md-3 mb-3">
                    <label for="validationTooltip">Mot de passe</label>
                    <input class="form-control" type="password" placeholder="Mot de passe" name="mdp" value="<?php if(isset($mdp)){ echo $mdp; }?>" required>
                    <input class="form-control" type="password" placeholder="Confirmer le mot de passe" name="confmdp" required>
                    <?php
                        if (isset($er_mdp)){
                    ?>
                            <div><?= $er_mdp ?></div>
                    <?php   
                        }
                    ?>
                </div>
                <button class="btn btn-primary" type="submit" name="inscription">S'enregistrer</button>
            </form>
        </div>

<?php include '../../../config/footer.php' ?>