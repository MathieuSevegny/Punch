<?php

require_once('../include/configuration.php');

$iduser = '';

$password = '';


// Retrouve les données du formulaire.

if (isset($_REQUEST['iduser'])) {

    $iduser = $_REQUEST['iduser'];
}
if (isset($_REQUEST['password'])) {

    $password = $_REQUEST['password'];
}


// Valide les données.

$message = '';

if ('' == $iduser) {

    $message .= "code d'usager manquant";
}
if ('' == $password) {

    $message = "mot de passe manquant";

}


if ('' == $message) {


    // Tente l'enregistrement des données.


    $sql= "SELECT usagers.motdepasse as password, employes.actif as actif  FROM employes INNER JOIN usagers ON employes.id = usagers.employes_id where employes.id= :iduser";
    $stmt = $conn->prepare($sql);


    if ($stmt) {

        $stmt->bindParam(':iduser', $iduser, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach($result as $row){

            $passwordhash = $row["password"];
            $actif = $row["actif"];
        }

        $ok = password_verify($password, $passwordhash);
        if ($ok) {
            if ($actif == 1) {

                $sql2 = "INSERT INTO punch (employes_id) VALUES (?)";
                $stmt= $conn->prepare($sql2);
                $stmt->execute([$iduser]);


            } else {
                $redirection = "index.php?error=1";

            }


        } else {
            $redirection = "index.php?error=2";
        }


//        $stmt->close();

    } else {

        $redirection = "index.php?error=3";


    }

} else {
    $redirection = "index.php?error=4";

}
header("Location: ../$redirection");


require('../include/nettoyage.php');
exit;




