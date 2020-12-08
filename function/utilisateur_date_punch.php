<?php
include("../include/configuration.php");
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $date = $_POST["date"];


    $sql = "SELECT punchtype_id as type,moment, employes_id, id FROM punch where employes_id= :id AND moment LIKE '$date%' order by moment asc";
    $stmt = $conn->prepare($sql);


    if ($stmt) {

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        echo "<form>";
        foreach ($result as $row) {
            $moment = $row["moment"];
            $employes = $row["employes_id"];

            $heure = explode(" ", $moment);
            $idpunch = $row["id"];
            $type = $row["type"];
            if ($type === "1") {
                $select = "<select name='type' id=\"inputState\" class=\"form-control formulaire\">
        <option value='1' selected>IN</option>
        <option value='2'>OUT</option>
      </select>";

            } else {
                $select = "<select name='type' id=\"inputState\" class=\"form-control formulaire\">
        <option value='1'>IN</option>
        <option value='2' selected>OUT</option>
      </select>";
            }
            echo " <div class=\"row mb-5\">
    <div class=\"col\">
          <input name='idpunch' type=\"hidden\" class=\"form-control formulaire\" value='$idpunch'>

      <input name='employes' type=\"hidden\" class=\"form-control formulaire\" value='$employes'>
      <input name='date' type=\"hidden\" class=\"form-control formulaire\" value='$heure[0]' >
      <input name='heure' type=\"text\" id='allo' class=\"form-control formulaire\" value='$heure[1]' >
    </div>
    <div class=\"col\">
            $select
    </div>
            <div class='col'>
            <button type='button' id='$idpunch' class='delete btn btn-danger'>Supprimer</button>

</div>

  </div>";

        }
        echo "<div class='row mt-5'>
            <button type='button'  class='addrow btn btn-success mx-auto'>Ajouter</button>

</div>";
        echo "</form>";


    }

}


include("../include/nettoyage.php");