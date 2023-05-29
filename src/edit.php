<?php

if (!array_key_exists("id", $_GET)) {
    header("location: ../public/index.php");
}

require('connection.php');
$connection = connect();

$id = $_GET["id"];

$query = "DELETE FROM Catalogo_Evidencia WHERE Id_Publicacion=$id";
mysqli_query($connection, $query);

if (array_key_exists("del", $_GET)) {
    $query = "DELETE FROM Publicacion WHERE Id=$id";
    mysqli_query($connection, $query);
    mysqli_close($connection);
    header("location: ../public/index.php");
}

$query = "SELECT Nombre FROM Catalogo_Evidencia WHERE Id_Publicacion=$id";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_array($result)) {
    if (!unlink($row["Nombre"])) {
        exit;
    }
}

$query = "SELECT * FROM Publicacion WHERE Id=$id";
$row = mysqli_fetch_array(mysqli_query($connection, $query));

$title = $row["Titulo"];
$comment = $row["Comentario"];
$type = $row["Tipo"];
$area = $row["Id_Area"];
$anonymus = $row["Anonimo"];

$redir = "<form id=\"data\" name=\"data\" method=\"post\" action=\"../public/nuevapublicacion.php?pid=$id\">" .
     "<input type=\"hidden\" name=\"title\" value=\"$title\">" .
     "<input type=\"hidden\" name=\"comment\" value=\"$comment\">" .
     "<input type=\"hidden\" name=\"type\" value=\"$type\">" .
     "<input type=\"hidden\" name=\"area\" value=\"$area\">" .
     "<input type=\"hidden\" name=\"anonymus\" value=\"$anonymus\">" .
     "<input type=\"hidden\" name=\"err\" value=\"0\">" .
     "</form>" .
     "<script type=\"text/javascript\">" .
     "document.getElementById('data').submit();" .
     "</script>";

mysqli_close($connection);

echo $redir;

?>
