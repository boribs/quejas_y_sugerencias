<?php

session_start();

if (!array_key_exists("username", $_SESSION)) {
    header("location: ../public/index.php");
}

require('connection.php');
$connection = connect();

$op = $_SESSION["id"];
$pub_id = $_POST["pub_id"];
$comment = $_POST["response"];

$query = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES
          WHERE TABLE_SCHEMA = 'quejas_sugerencias_db' AND TABLE_NAME = 'Respuesta_Publicacion'";
$res_id = mysqli_fetch_array(mysqli_query($connection, $query))["AUTO_INCREMENT"];

$query = "INSERT INTO Respuesta_Publicacion (Id_Usuario, Comentario, Fecha) VALUES ($op, '$comment', CURDATE())";
mysqli_query($connection, $query);

$query = "INSERT INTO Catalogo_Respuesta (Id_Publicacion, Id_Respuesta) VALUES ($pub_id, $res_id)";
mysqli_query($connection, $query);

header("location: ../public/publicacion.php?id=$pub_id");

mysqli_close($connection);

?>
