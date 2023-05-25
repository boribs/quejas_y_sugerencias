<?php
session_start();

if (!$_SESSION["username"]) {
    header("location: ../public/index.php");
}

define("EVIDENCE_PATH", "../public/evidence/");
$evidence_files = scandir(EVIDENCE_PATH);

require("connection.php");

$user_id = $_SESSION["id"];
$title = trim($_POST["title"]);
$comment = trim($_POST["comment"]);
$type = $_POST["type"];
$area = $_POST["area"];
$anonymus = $_POST["anonymus"] == "on" ? "TRUE" : "FALSE";
// $mediacount = $_POST["mediacount"];

foreach ($_FILES["evidencia"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["evidencia"]["tmp_name"][$key];
        $name = $_FILES["evidencia"]["name"][$key];

        while (in_array($name, $evidence_files)) {
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $name = uniqid() . ".$ext";
        }

        array_push($evidence_files, $name);
        $path = EVIDENCE_PATH . "$name";
        move_uploaded_file($tmp_name, $path);
    }
}

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
