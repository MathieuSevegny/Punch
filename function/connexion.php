<?php


require_once('../include/configuration.php');

$iduser = '';

$password = '';

$actif = 0;
$admin = 0;

// Retrouve les données du formulaire.

if (isset($_REQUEST['code'])) {

    $iduser = $_REQUEST['code'];
}
if (isset($_REQUEST['motdepasse'])) {

    $password = $_REQUEST['motdepasse'];
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


    $sql = "SELECT usagers.id AS id, usagers.image AS image, usagers.admin AS admin,CONCAT(employes.prenom, ' ', employes.nom) AS nom, usagers.motdepasse as password, employes.actif as actif  FROM employes INNER JOIN usagers ON employes.id = usagers.employes_id where usagers.code = :iduser";
    $stmt = $conn->prepare($sql);


    if ($stmt) {

        $stmt->bindParam(':iduser', $iduser, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach ($result as $row) {

            $passwordhash = $row["password"];
            $actif = $row['actif'];
            $nom = $row['nom'];
            $id = $row['id'];
            $image = $row['image'];
            $admin = $row['admin'];
            echo $nom;
        }

        $ok = password_verify($password, $passwordhash);
        if ($ok) {
            if ($actif == 1) {
                if ($admin == 1) {
                    $_SESSION['isConnected'] = true;
                    $_SESSION['messageusager'] = "Bienvenue $nom !";
                    $_SESSION['id'] = $id;
                    $_SESSION['image'] = $image;
                    $_SESSION['nom'] = $nom;
                    $_SESSION['admin'] = $admin;
                    $redirection = 'dashboard.php';
                }else{
                    $redirection = "index.php?error=5";
                }


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
