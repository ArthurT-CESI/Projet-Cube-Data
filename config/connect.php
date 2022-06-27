<?php
    
    //Récupérer l'accès a mongoDB - lien depuis Atlas
    $manager = new MongoDB\Driver\Manager('mongodb+srv://dataAdmin:dataAdmin@clustercubedata.nzqrl.mongodb.net');
    // Construct and execute the listDatabases command
    $listdatabases = new MongoDB\Driver\Command(["listDatabases" => 1]);
    $result = $manager->executeCommand("admin", $listdatabases);
    $databases = $result->toArray()[0];

?>