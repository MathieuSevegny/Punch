<?php
//require '../include/configuration.php';
//
//if (isset($_POST["id"])) {
//    $id = $_POST["id"];
//    $moment = $_POST["moment"]." ".$_POST["heure"];
//    $type = $_POST["typepunch"];
//
//    $sql = "UPDATE punch SET moment=?, punchtype_id=? WHERE id=?";
//    $stmt= $conn->prepare($sql);
//    $stmt->execute([$moment,$type,$id]);
//
//}
//
//
//require '../include/nettoyage.php';
@session_start();


require '../include/configuration.php';

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $moment = $_POST["moment"]." ".$_POST["heure"];
    $type = $_POST["typepunch"];
    $usager_id = $_SESSION['id'];

    $sql = "CALL log(?,?,?,?)";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$moment,$id,$type,$usager_id]);

}


require '../include/nettoyage.php';