<?php

session_start();

if (!array_key_exists("username", $_SESSION)) {
    header("location: ../public/index.php");
}

if (!array_key_exists("id", $_GET)) { // si no está la id, regresa
    header("location: ../public/index.php");
}

require("../src/connection.php");
$connection = connect();
$id = $_GET["id"];

$query = "SELECT Titulo, Comentario, Fecha, Anonimo, (SELECT Nombre FROM Usuario WHERE Id = Id_Usuario) as Usuario, Id_Usuario, Resuelto FROM Publicacion WHERE Id = $id";

$result = mysqli_query($connection, $query);

if (!$result) {
    // Error!
}

$row = mysqli_fetch_array($result);

// var_dump($row);

$title = $row["Titulo"];
$comment = $row["Comentario"];
$date = $row["Fecha"];
$anonymus = $row["Anonimo"] == "1";
$user = $anonymus ? "Anónimo" : $row["Usuario"];
$user_id = $row["Id_Usuario"];
$resolved = $row["Resuelto"];

function get_evidence() {
    global $connection, $id;

    $query = "SELECT Nombre FROM Catalogo_Evidencia WHERE Id_Publicacion = $id";
    $result = mysqli_query($connection, $query);

    if ($result->num_rows == 0) {
        echo "<li class=\"evi\">Sin evidencias</li>";
    } else {
        while ($row = mysqli_fetch_array($result)) {
            $path = $row["Nombre"];
            $basename = pathinfo($path)["basename"];

            echo "<li class=\"evi\"><a class=\"no-decor\" href=\"$path\" target=\"_blank\">
                    <img src=\"../assets/images/icono-imagen.png\">
                    <p>$basename</p>
                  </a></li>";
        }
    }
}

function create_comment_dom($row) {
    global $user_id;

    $user = $row["Usuario"];
    $is_author = $row["Id_Usuario"] == $user_id ? "by-author" : "";
    $comment = $row["Comentario"];
    $date = $row["Fecha"];

    echo "<li>
         <div class=\"comment-box\">
             <div class=\"comment-head\">
                 <h6 class=\"comment-name $is_author\">$user</h6>
                 <span>$date</span>
             </div>
             <div class=\"comment-content\">$comment</div>
         </div>
         </li>";
}

function get_comments() {
    global $id, $connection;

    $query = "SELECT (SELECT Nombre FROM Usuario WHERE Id=(SELECT Id_Usuario FROM Respuesta_Publicacion WHERE Id=Id_Respuesta)) as Usuario, (SELECT Id_Usuario FROM Respuesta_Publicacion WHERE Id=Id_Respuesta) as Id_Usuario, (SELECT Comentario FROM Respuesta_Publicacion WHERE Id=Id_Respuesta) as Comentario, (SELECT Fecha FROM Respuesta_Publicacion WHERE Id=Id_Respuesta) as Fecha FROM Catalogo_Respuesta WHERE Id_Publicacion = $id";

    $result = mysqli_query($connection, $query);
    if ($result->num_rows == 0) {
        echo "<div class=\"no-comment-div\"></div>";
    } else {
        while (($row = mysqli_fetch_array($result))) {
            create_comment_dom($row);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../assets/css/publicacion.css">
    <title>Quejas FCC | Publicacion</title>
    <link rel="icon" type="image/png" href="../assets/images/escudo-buap.png">
</head>
<body>
    <div id="header-and-main">
        <header id="top-header" class="row">
            <a href="https://www.buap.mx" target="_blank">
                <img id="BUAP-logo" src="../assets/images/logo-buap-h.png">
            </a>
            <div class="separator"></div>
            <a href="https://www.cs.buap.mx/" target="_blank" class="no-decor">
                <div class="header-right header-button">Contacto FCC</div>
            </a>
            <a href="../src/logout.php" class="no-decor">
                <?php
                if (array_key_exists("username", $_SESSION)) {
                    echo "<div class=\"header-right header-button\">Cerrar sesión</div>";
                }
                ?>
            </a>
        </header>

        <main>
            <div id="main-content">
                <div id="forum-container">
                    <div class="comments-container">
                        <h1><?php
                        if ($resolved) {
                            echo "[Resuelto] $title";
                        } else {
                            echo $title;
                        }
                        ?></h1>

                        <ul id="comments-list" class="comments-list">
                            <li>
                                <div class="comment-main-level">
                                    <!-- Contenedor del Comentario -->
                                    <div class="comment-box">
                                        <div class="comment-head">
                                            <h6 class="comment-name by-author"><?php echo $user; ?></h6>
                                            <span><?php echo $date; ?></span>
                                            <?php
                                            $t = getdate();
                                            $y = $t["year"];
                                            $m = str_pad($t["mon"], 2, "0", STR_PAD_LEFT);
                                            $d = str_pad($t["mday"], 2, "0", STR_PAD_LEFT);
                                            $today = "$y-$m-$d";

                                            if ($_SESSION["id"] == $user_id && $today == $date) {
                                                echo "<a class=\"button-right\" href=\"../src/edit.php?id=$id\">Editar</a>";
                                                echo "<a class=\"button-right\" href=\"../src/edit.php?id=$id&del=1\">Borrar</a>";
                                            }

                                            if ($_SESSION["id"] == 1 && !$resolved) { // admin
                                                echo "<a class=\"button-right\" href=\"../src/resolve.php?id=$id\">Resolver</a>";
                                            }
                                            ?>
                                        </div>
                                        <div class="comment-content">
                                            <?php echo $comment; ?>
                                        </div>
                                        <hr>
                                        <div class="evidence-content">
                                            <ul>
                                                <?php get_evidence(); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Respuestas de los comentarios -->
                                <ul class="comments-list reply-list">
                                    <?php get_comments(); ?>
                                </ul>
                            </li>
                        </ul>
                        <hr id="big-margin">
                        <div class="form-container">
                            <form action="../src/response.php" method="post" enctype="multipart/form-data">
                                <textarea name="response"></textarea>
                                <div class="button-area">
                                    <button type="submit" name="cancelar" class="button--area">
                                        Responder
                                    </button>
                                    <a href="index.php">
                                        <button form="none" class="button--area">
                                            Regresar al inicio
                                        </button>
                                    </a>
                                </div>
                                <input type="hidden" name="pub_id" value="<?php echo $id; ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <footer class="row">
        <div class="footer-text-element">BUAP 2023</div>
        <div class="separator"></div>
        <div class="footer-text-element">Cristian Gotchev</div>
        <div class="footer-text-element">Irving Hernández</div>
    </footer>
</body>
</html>
<?php mysqli_close($connection); ?>
