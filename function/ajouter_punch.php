<?php

require '../include/configuration.php';

if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $moment = $_POST["moment"] ." 12:00:00";
    $sql = "INSERT INTO punch (employes_id, moment, punchtype_id) VALUES (?,?,1)";
    $conn->prepare($sql)->execute([$id, $moment]);

}


require '../include/nettoyage.php';