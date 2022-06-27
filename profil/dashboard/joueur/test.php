<?php
    function abc(){
        // Your code here
    //On récupère l'enchère gagnante
              $options = [];
              $filter = ['JoueurId' => new \MongoDB\BSON\ObjectID($_SESSION['id_joueur']), 'JeuId' => new \MongoDB\BSON\ObjectID($jeu->_id), 'Gagner' => "True"];
              $query = new \MongoDB\Driver\Query($filter, $options);
              $cursor = $manager->executeQuery('dbCube.Encheres', $query);
              $cursorArray = $cursor->toArray();
              $enchere = current($cursorArray);

              //On récupère l'annonce de l'enchère
              $options = [];
              $filter = ['_id' => new \MongoDB\BSON\ObjectID($enchere->AnnonceId)];
              $query = new \MongoDB\Driver\Query($filter, $options);
              $cursor = $manager->executeQuery('dbCube.Annonces', $query);
              $cursorArray = $cursor->toArray();
              $annonce = current($cursorArray);
    }
?>



