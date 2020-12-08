<?php
include ("../include/configuration.php");
if (isset($_POST["id"])){
    $id = $_POST["id"];

    $sql= "SELECT CONCAT(employes.prenom, ' ', employes.nom) as nom  FROM employes where employes.id= :id";
    $stmt = $conn->prepare($sql);


    if ($stmt) {

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach($result as $row){

            echo $row["nom"];
        }




    }

}



include ("../include/nettoyage.php");