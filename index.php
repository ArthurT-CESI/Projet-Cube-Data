
<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="styles/style.css" media="screen" type="text/css" />
        
        <link rel="shortcut icon" href="favicon.ico?v=2" type="image/x-icon">

        <title>Projet Cube Data</title>
    </head>

    <body>
        <h1 style="color: white">Publikeco</h1>
        <div id="container">
            <!-- zone de connexion -->
            <form id="formulaire" action="profil/verification.php" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Email</b></label>
                <input type="text" placeholder="Entrer votre email" name="mail" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                
                <br><br>

                <label>Statut : </label>
                <input type="radio" name="role" value="Joueur" required>Joueur
                <input type="radio" name="role" value="Annonceur">Annonceur
                <input type="radio" name="role" value="Editeur">Editeur
                <input type="radio" name="role" value="Admin">Admin

                <br><br>

                <input type="submit" id='submit' value='Se connecter' >

                <br><br>
                
                <a href="/profil/dashboard/joueur/inscription_joueur.php">Nouveau joueur ? Créez votre profil ici !</a><br><br>
                <a href="/profil/dashboard/annonceur/inscription_annonceur.php">Nouvel annonceur ? Créez votre profil ici !</a><br><br>
                <a href="/profil/dashboard/editeur/inscription_editeur.php">Nouvel éditeur ? Créez votre profil ici !</a>
                
                <?php
                    if(isset($_GET['erreur'])){
                        $err = $_GET['erreur'];
                        if($err==1 || $err==2)
                            echo "<p style='color:red'>Email ou mot de passe incorrect</p>";
                    }
                ?>
                
            </form>
        </div>
    </body>
</html>