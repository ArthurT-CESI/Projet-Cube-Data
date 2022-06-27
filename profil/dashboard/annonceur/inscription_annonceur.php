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
            $categorie  = htmlentities(trim($choixCategorie)); // On récupère la catégorie
            $logo = htmlentities(trim($logo)); // on récupère le logo
            $mail = htmlentities(trim($mail)); // On récupère le mail
            $nom = htmlentities(trim($nom)); // On récupère le nom 
            $mdp = htmlentities(trim($mdp)); // On récupère le mot de passe 
            $confmdp = htmlentities(trim($confmdp)); //  On récupère la confirmation du mot de passe
            $pays = htmlentities(trim($choixPays)); // On récupère le pays 
            $site = htmlentities(trim($site)); // On récupère le lien du site 

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
                //En fonction du rôle
                $rows   = $manager->executeQuery('dbCube.Annonceurs', $query);
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
                 'categorie' => $categorie, 
                 'logo' => $logo,
                 'mail' => $mail,
                 'nom' => $nom,
                 'password' => $mdp,
                 'pays' => $pays,
                 'site' => $site,
                 'dateDeCreation' => $date_creation_compte
                ]);

                $change = $manager->executeBulkWrite('dbCube.Annonceurs', $bulk);
                header('Location: ../annonceur/annonceur.php');
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
            <h1 style="color: white">Inscription annonceur</h1>
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

                <div class="col-md-3 mb-3">
                    <label for="validationTooltip"><b>logo</label>
                    <input class="form-control" type="text" placeholder="Insérez le lien de votre logo" name="logo" value="<?php if(isset($logo)){ echo $logo; }?>">
                    <?php
                        if (isset($logo)){
                    ?>
                            <div style='color:red'><?= $logo ?></div>
                    <?php
                        }
                    ?>   
                </div>

                <div class="col-md-3 mb-3">
                    <label for="validationTooltip"><b>Site</label>
                    <input class="form-control" type="text" placeholder="Insérez le lien de votre site web" name="site" value="<?php if(isset($site)){ echo $site; }?>">
                    <?php
                        if (isset($site)){
                    ?>
                            <div style='color:red'><?= $site ?></div>
                    <?php
                        }
                    ?>   
                </div>

                <div class="col-md-3 mb-3">
                <br>
                <?php //début du programme
                    $pays = array('Afrique du sud','Algerie','Allemagne','Arabie saoudite','Australie','Autriche','Belgique','Bresil','Canada','Chili','Chine','Colombie','Corée du sud','Danemark','Emirats arabes unis','Espagne','Etats-Unis','Finlande','France','Hong-Kong','Inde','Indonesie','Irlande','Italie','Japon','Luxembourg','Malaisie','Mexique','Norvege','Pays-Bas','Philippine','Quatar','Royaume-Uni','Singapoure','Suède','Suisse','Taiwan','Tchequie','Turquie','Venezuela');
                    echo "<b>Quels est votre pays ?<br><br>";
                    echo "<SELECT NAME=choixPays>";
                    for ($count=0;$count<40;$count++)
                        {
                            echo "<OPTION value=$pays[$count]>$pays[$count]</OPTION>";
                        }
                    echo "</select>";
                ?>
                </div>
                <br>

                <div class="col-md-4 mb-4">
                <b>Choississez votre catégorie d'annonceur<br><br>
                <?php //début du programme
                    $categorie = array('accounting','airlines/aviation','apparel & fashion','automotive','aviation & aerospace','banking','biotechnology','broadcast media','building materials','business supplies and equipment','capital markets','chemicals','civic & social organization','civil engineering','commercial real estate','computer hardware','computer networking','computer software','construction','consumer electronics','consumer goods','consumer services','cosmetics','defense & space','design','education management','electrical/electronic manufacturing','entertainment','environmental services','facilities services','farming','financial services','food & beverages','food production','glass, ceramics & concrete','government administration','graphic design','health, wellness and fitness','higher education','hospital & health care','hospitality','human resources','individual & family services','industrial automation','information services','information technology and services','insurance','international affairs','international trade and development','internet','investment banking','judiciary','law enforcement','law practice','legal services','legislative office','leisure, travel & tourism','logistics and supply chain','luxury goods & jewelry','machinery','management consulting','marketing and advertising','mechanical or industrial engineering','media production','medical devices','medical practice','mental health care','military','mining & metals','motion pictures and film','music','non-profit organization management','oil & energy','outsourcing/offshoring','package/freight delivery','packaging and containers','paper & forest products','pharmaceuticals','photography','primary/secondary education','printing','professional training & coaching','public policy','public relations and communications','publishing','railroad manufacture','real estate','renewables & environment','research','restaurants','retail','security and investigations','semiconductors','sporting goods','staffing and recruiting','supermarkets','telecommunications','textiles','tobacco','translation and localization','transportation/trucking/railroad','utilities','wholesale','wine and spirits','wireless','writing and editing');

                    echo "<SELECT NAME=choixCategorie>";
                    for ($count=0;$count<=105;$count++)
                        {
                            echo "<OPTION value=$categorie[$count]>$categorie[$count]</OPTION>";
                        }
                    echo "</select>";
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