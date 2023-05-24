<?php
session_start();

if (!$_SESSION["username"]) {
    header("location: ../public/index.php");
}

require("connection.php");

$user_id = $_SESSION["id"];
$title = trim($_POST["title"]);
$comment = trim($_POST["comment"]);
$type = $_POST["type"];
$area = $_POST["area"];
$anonymus = $_POST["anonymus"] == "on" ? "TRUE" : "FALSE";
// $mediacount = $_POST["mediacount"];

if (!$title || !$comment) {
    // Error
    echo "Error 1!";
}

$connection = connect();
$query = "INSERT INTO Publicacion (Tipo, Id_Usuario, Titulo, Comentario, Fecha, Id_Area, Resuelto, Anonimo) " .
         "VALUES ($type, $user_id, \"$title\", \"$comment\", CURDATE(), $area, FALSE, $anonymus)";

echo "<br>" . $query;

if (!mysqli_query($connection, $query)) {
    // Error
    echo "Error 2!";
}

mysqli_close($connection);

header("location: ../public/index.php");
?>
