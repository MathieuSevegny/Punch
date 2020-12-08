<?php
@session_start();
$servername = "localhost";
$username = "root";
$password = "mysql";
$db = "punch";
define('DEVEL', true);

try {
    $conn = new PDO("mysql:host=$servername;port=3306;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connection à la base de donnée: " . $e->getMessage();
}
