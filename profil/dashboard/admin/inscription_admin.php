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
            $nom  = htmlentities(trim($nom)); // On récupère le nom
            $prenom = htmlentities(trim($prenom)); // on récupère le prénom
            $mail = htmlentities(strtolower(trim($mail))); // On récupère le mail
            $mdp = trim($mdp); // On récupère le mot de passe 
            $confmdp = trim($confmdp); //  On récupère la confirmation du mot de passe

            //  Vérification du nom
            if(empty($nom)){
                $valid = false;
                $er_nom = ("Le nom d' utilisateur ne peut pas être vide");
            }       

            //  Vérification du prénom
            if(empty($prenom)){
                $valid = false;
                $er_prenom = ("Le prenom d' utilisateur ne peut pas être vide");
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
                $rows   = $manager->executeQuery('dbCube.Admins', $query);
                
                $req_mail = "";

                foreach ($rows as $document) {
                        $req_mail = $document->mail;
                    }

                if ($req_mail <> ""){
                    $valid = false;
                    $er_mail = "Ce mail existe déjà : $mail <br>";
                }
            }

            // Vérification du pseudo
            if(empty($pseudo)){
                $valid = false;
                $er_pseudo = "Le pseudo ne peut pas être vide";
            }else{
                // On vérifie que le pseudo est disponible
                $filter = ['pseudoAdmin' => $pseudo];
                $options = [];
                $query = new \MongoDB\Driver\Query($filter, $options);
                $rows   = $manager->executeQuery('dbCube.Admins', $query);

                $req_pseudo = "";

                foreach ($rows as $document) {
                        $req_pseudo = $document->pseudoAdmin;
                    }

                if ($req_pseudo <> ""){
                    $valid = false;
                    $er_pseudo = "Ce pseudo existe déjà : $pseudo <br>";
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
                 'pseudoAdmin' => $pseudo, 
                 'password' => $mdp,
                 'nomAdmin' => $nom,
                 'prenomAdmin' => $prenom,
                 'mail' => $mail,
                 'age' => $age,
                 'sexe' => $sexe,
                 'dateDeCreation' => $date_creation_compte,
                ]);

                $change = $manager->executeBulkWrite('dbCube.Admins', $bulk);
                
                header('Location: admin.php');
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
            <a href="admin.php" class="btn btn-warning">Retour</a>
        </div>    
            
        <div class="container" style="text-align: center;">
            <h1 style="color: white">Ajouter un administrateur</h1>
        </div>

        <div class="container">
            <form id="formulaire" method="post">
                <div class="col-md-3 mb-3">
                    <label for="validationTooltip">Nom</label>
                    <input class="form-control" type="text" placeholder="Nom" name="nom" value="<?php if(isset($nom)){ echo $nom; }?>" required> 
                
                <?php
                    // S'il y a une erreur sur le nom alors on affiche
                    if (isset($er_nom)){
                ?>
                    <div style='color:red'><?= $er_nom ?></div>
                    
                <?php   
                    }
                ?>  
        
                </div>

                <div class="col-md-3 mb-3">
                    <label for="validationTooltip">Prénom</label>
                    <input class="form-control" type="text" placeholder="Prénom" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; }?>" required>
                    <?php
                        if (isset($er_prenom)){
                    ?>
                            <div style='color:red'><?= $er_prenom ?></div>
                    <?php
                        }
                    ?>   
                </div>

                <div class="col-md-3 mb-3">
                    <label for="validationTooltip">Age</label>
                    <br>
                    <input type="range" name="age" id="age" min="1" max="120" step="1"  value="<?php if(isset($age)){ echo $age; }?>" oninput="this.form.amountInput.value=this.value" required/>
                    <br>
                    <input type="number" name="amountInput" min="1" max="120" value="<?php if(isset($age)){ echo $age; }?>" oninput="this.form.age.value=this.value" />
                    <?php
                        if (isset($er_age)){
                    ?>
                            <div><?= $er_age ?></div>
                    <?php
                        }
                    ?>
                </div>

                <br>
                
                <label for="validationTooltip">Genre</label>
                <br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexe" id="Homme" value="Homme" checked>
                    <label class="form-check-label" for="inlineRadio1">Homme</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexe" id="Femme" value="Femme">
                    <label class="form-check-label" for="inlineRadio2">Femme</label>
                </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sexe" id="NonBinaire" value="NonBinaire">
                    <label class="form-check-label" for="inlineRadio3">Non binaire</label>
                </div>
                <br>

                <div class="col-md-3 mb-3">
                    <label for="validationTooltip">Pseudo</label>
                    <input class="form-control" type="text" placeholder="Pseudo" name="pseudo" value="<?php if(isset($pseudo)){ echo $pseudo; }?>" required>
                    <?php
                        if (isset($er_pseudo)){
                    ?>
                            <div style='color:red'><?= $er_pseudo ?></div>
                    <?php   
                        }
                    ?>
                </div>

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