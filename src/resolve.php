<?php

session_start();
if (!array_key_exists("id", $_SESSION)) {
    header("location: ../public/index.php");
}

if (!array_key_exists("id", $_GET)) {
    header("location: ../public/index.php");
}

if ($_SESSION["id"] != 1) {
    header("location: ../public/index.php");
}

require('connection.php');
$connection = connect();

$id = $_GET["id"];
$query = "UPDATE Publicacion SET Resuelto = TRUE WHERE Id = $id";
mysqli_query($connection, $query);

mysqli_close($connection);

header("location: ../public/index.php");

?>
