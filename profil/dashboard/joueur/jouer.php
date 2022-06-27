<?php
    
    include '../../../config/header.php';
    include '../../../config/connect.php';
    session_start();

    if (isset($_GET['id'])) {
        $_SESSION['id_jeu'] = $_GET['id'];
        $options = [];
        $filter = ['_id' => new \MongoDB\BSON\ObjectID($_GET['id'])];
        $query = new \MongoDB\Driver\Query($filter, $options);

        $cursor = $manager->executeQuery('dbCube.Jeux', $query);
        $cursorArray = $cursor->toArray();

        $jeu = current($cursorArray);

        if (isset($_SESSION['id_joueur'])) {
          //on vérifie qu'il n'est pas déjà dans la table jouer
          $options = [];
          $filter = ['id_joueur' => new \MongoDB\BSON\ObjectID($_SESSION['id_joueur']), 'id_jeu' => new \MongoDB\BSON\ObjectID($jeu->_id)];
          $query = new \MongoDB\Driver\Query($filter, $options);
          $cursor = $manager->executeQuery('dbCube.Jouer', $query);
          $cursorArray = $cursor->toArray();
          $jouer = current($cursorArray);
          if ($jouer == Null){
            // On insert nos données dans la table utilisateur
            $bulk = new MongoDB\Driver\BulkWrite;
            $bulk -> insert(['_id' => new MongoDB\BSON\ObjectID,
            'id_joueur' => $_SESSION['id_joueur'], 
            'id_jeu' => $jeu->_id
            ]);
            $change = $manager->executeBulkWrite('dbCube.Jouer', $bulk);
          }
        }else{
          echo "Une erreur est survenue [ID_JOUEUR]";
        }

    }else{
      echo "Une erreur est survenue [ID_JEU]";
    }

?>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $("button").click(function(){
            $.ajax({
                type: 'POST',
                url: 'script.php',
                success: function(data) {
                  $("#imagePub").attr('src',data);
                }
            });
   });
});
</script>
</head>


<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  /* The image used */
  background-image: url("<?php echo $jeu->imageJeu ?>");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.center {
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

.centre{
  text-align: center;
}

</style>

<div class="bg">
  <a href='jeux_jouer.php' class='btn btn-danger btn-sm'>Quitter</a>
</div>

<div class="center">
  <!-- Trigger the modal with a button -->
  <button id="btn_script" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal" onclick="">Lancer la pub</button>
</div>

<!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        
        <!-- Modal content-->
        <div class="modal-content" style="display: inline-block;">
          <div class="card-header bg-dark centre">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span style="color:rgb(240, 173, 78);padding-right: 1%">&times;</span>
            </button>
      
            <h2 id="exampleModalLongTitle" style="color:rgb(240, 173, 78);"></h2> <!--<?php echo $annonce->Nom; ?>-->
          </div>
          <div id="div1" class="card-body centre">
            <img id="imagePub" style='width:100%;height:100%;' src="../../../images/exemple.jpg">
          </div>
          <div class="card-footer bg-dark centre">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Ça m'intéresse !</button>
          </div>
        </div>
      </div>
    </div>

