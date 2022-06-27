<?php

session_start();

if(isset($_POST['mail']) && isset($_POST['password'])){
   if($_POST['role'] == "Joueur"){
      // connexion à la base de données
      $mongo = new MongoDB\Driver\Manager('mongodb+srv://dataAdmin:dataAdmin@clustercubedata.nzqrl.mongodb.net');
      $filter = ['mail' => $_POST['mail'], 'password' => $_POST['password']];
      $options = [];
      $query = new \MongoDB\Driver\Query($filter, $options);
      $cursor = $mongo->executeQuery('dbCube.Joueurs', $query);
      $cursorArray = $cursor->toArray();

      $document = current($cursorArray);

      //Si correct;
      if($document->mail!=""){
         $_SESSION['id_joueur'] = $document->_id;
         $_SESSION['mail'] = $document->mail;
         header('Location: dashboard/joueur/joueur.php');
      }else{
         header('Location: ../index.php?erreur=1'); // utilisateur ou mot de passe incorrect
      }

   }elseif($_POST['role'] == "Annonceur"){
      // connexion à la base de données
      $mongo = new MongoDB\Driver\Manager('mongodb+srv://dataAdmin:dataAdmin@clustercubedata.nzqrl.mongodb.net');
      $filter = ['mail' => $_POST['mail'], 'password' => $_POST['password']];
      $options = [];

      $query = new \MongoDB\Driver\Query($filter, $options);
      $rows = $mongo->executeQuery('dbCube.Annonceurs', $query);

      foreach ($rows as $document) {
         $pseudo = $document->pseudoJoueur;
         $mail = $document->mail;
      }

      //Si correct;
      if($mail!=""){
         $_SESSION['id_annonceur'] = $document->_id;
         $_SESSION['mail'] = $mail;
         header('Location: dashboard/annonceur/annonceur.php');
      }else{
         header('Location: ../index.php?erreur=1'); // utilisateur ou mot de passe incorrect
      }

   }elseif($_POST['role'] == "Editeur"){
      // connexion à la base de données
      $mongo = new MongoDB\Driver\Manager('mongodb+srv://dataAdmin:dataAdmin@clustercubedata.nzqrl.mongodb.net');
      $filter = ['mail' => $_POST['mail'], 'password' => $_POST['password']];
      $options = [];

      $query = new \MongoDB\Driver\Query($filter, $options);
      $rows = $mongo->executeQuery('dbCube.Editeurs', $query);

      foreach ($rows as $document) {
         $pseudo = $document->pseudoJoueur;
         $mail = $document->mail;
      }

      //Si correct;
      if($mail!=""){
         $_SESSION['id_editeur'] = $document->_id;
         $_SESSION['mail'] = $mail;
         header('Location: dashboard/editeur/editeur.php');
      }else{
         header('Location: ../index.php?erreur=1'); // utilisateur ou mot de passe incorrect
      }

   }elseif($_POST['role'] == "Admin"){
      // connexion à la base de données
      $mongo = new MongoDB\Driver\Manager('mongodb+srv://dataAdmin:dataAdmin@clustercubedata.nzqrl.mongodb.net');
      $filter = ['mail' => $_POST['mail'], 'password' => $_POST['password']];
      $options = [];

      $query = new \MongoDB\Driver\Query($filter, $options);
      $rows = $mongo->executeQuery('dbCube.Admins', $query);

      foreach ($rows as $document) {
         $pseudo = $document->pseudoJoueur;
         $mail = $document->mail;
      }

      //Si correct;
      if($mail == isset($_POST['mail'])){
         $_SESSION['mail'] = $mail;
         header('Location: dashboard/admin/admin.php');
      }else{
         header('Location: ../index.php?erreur=1'); // utilisateur ou mot de passe incorrect
      }

   }else{
      header('Location: ../index.php');
   }
}else{
   header('Location: ../index.php');
}

?>