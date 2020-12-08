<?php
require '../include/configuration.php';

if (isset($_POST["id"])){



    //Deleting a row using a prepared statement.
    $sql = "DELETE FROM punch WHERE punch.id = :id";

//Prepare our DELETE statement.
    $statement = $conn->prepare($sql);

//The make that we want to delete from our cars table.
    $id = $_POST["id"];

//Bind our $makeToDelete variable to the paramater :make.
    $statement->bindValue(':id', $id);

//Execute our DELETE statement.
    $delete = $statement->execute();
        echo $id;
}
else{
    echo "id not set";
}



require '../include/nettoyage.php';
