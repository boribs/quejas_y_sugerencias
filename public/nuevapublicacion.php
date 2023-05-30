<?php
session_start();

if (!array_key_exists("username", $_SESSION)) {
    header("location: ../../public/login.html");
}

$info = false; //Esto lo puse por el error que me salia
$err = false;

// Se mandó la página con información, seguro hay un error
if (array_key_exists("title", $_POST)) {
    $info = true;
    $title = trim($_POST["title"]);
    $comment = trim($_POST["comment"]);
    $type = $_POST["type"];
    $area = $_POST["area"];
    $anonymus = $_POST["anonymus"];
    $err = $_POST["err"] == "1";
}

require('../src/connection.php');
$connection = connect();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../assets/css/nuevapublicacion.css">
    <title>Nueva Publicación | Quejas FCC</title>
    <link rel="icon" type="image/png" href="../assets/images/escudo-buap.png">
</head>
<body>
    <div id="header-and-main">
        <header id="top-header" class="row">
            <a href="https://www.buap.mx" target="_blank">
                <img id="BUAP-logo" src="../assets/images/logo-buap-h.png">
            </a>
            <div class="separator"></div>
            <a href="../public/index.php" target="_blank" class="no-decor">
                <div class="header-right header-button">Inicio</div>
            </a>
            <a href="https://www.cs.buap.mx/" target="_blank" class="no-decor">
                <div class="header-right header-button">Contacto FCC</div>
            </a>
            <a href="../src/logout.php" class="no-decor">
                <div class="header-right header-button">Cerrar sesión</div>
            </a>
            <!-- <div class="header-right">Contacto FCC</div>
            <div class="header-right">
                <a href="index.html">
                    <img class="round-image" src="../assets/images/usuario.png" alt="Descripción de la imagen">
                </a>
            </div> -->
            <!-- Podriamos poner esto para mostrar cuando se logee el usuario y si no dejamos que diga bienvenido -->
        </header>

        <main>
            <div id="main-content">
                <div id="forum-container">
                    <?php
                        if ($info && $err) {
                            echo "<div class=\"err-div\">Ocurrió un error, por favor revise su publicación.</div>";
                        }
                    ?>
                    <form id="publication-form" action="../src/procesar.php" method="post" enctype="multipart/form-data">
                        <?php
                        echo "<input type=\"hidden\" name=\"err\" value=\"$err\">";
                        if (array_key_exists("pid", $_GET)) {
                            $pub_id = $_GET["pid"];
                            echo "<input type=\"hidden\" name=\"pub_id\" value=\"$pub_id\">";
                        }
                        ?>
                        <h1>Nueva publicación</h1>
                        <div class="option-area">
                            <div class="publication-option">
                                <p class="text-form">Tipo de publicación</p>
                                <div class="select">
                                    <select name="type">
                                        <?php
                                        $query = "SELECT Id, Nombre FROM Tipo_Publicacion";
                                        $result = mysqli_query($connection, $query);

                                        while (($row = mysqli_fetch_array($result))) {
                                            $nombre = $row["Nombre"];
                                            $id = $row["Id"];
                                            if ($info && $type == $id) {
                                                echo "<option value=\"$id\" selected>$nombre</option>";
                                            } else {
                                                echo "<option value=\"$id\">$nombre</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="department-option">
                                <p class="text-form">Dirigido a</p>
                                <div class="select">
                                    <select name="area">
                                        <?php
                                        $query = "SELECT Id, Nombre FROM Area";
                                        $result = mysqli_query($connection, $query);

                                        while (($row = mysqli_fetch_array($result))) {
                                            $nombre = $row["Nombre"];
                                            $id = $row["Id"];
                                            if ($info && $area == $id) {
                                                echo "<option value=\"$id\" selected>$nombre</option>";
                                            } else {
                                                echo "<option value=\"$id\">$nombre</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="anonymous-option">
                                <p class="text-form">Publicación anónima</p>
                                <div class="checkbox">
                                    <input type="checkbox" name="anonymus" <?php if ($info && $anonymus) { echo "checked"; }?>>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="message-area">
                            <p class="text-form">Título de publicación</p>
                            <textarea class="title-area" id="msg" name="title" required><?php if($info) { echo "$title"; } ?></textarea>
                            <p class="text-form">Explique su publicación</p>
                            <textarea class="text-area" id="cmt" name="comment" required><?php if($info) { echo "$comment"; } ?></textarea>
                        </div>
                        <hr>
                        <div class="evidence-area">
                            <label id="button-evidence-label">
                                <input id="button-evidence-input" type="file" name="evidencia[]" accept="video/*,image/*" multiple>
                                Adjuntar evidencia
                            </label>
                            <div id="evidence-preview"></div>
                        </div>
                        <hr>
                        <div class="button-area">
                            <a href="index.php">
                                <button class="button--area" form="none">
                                    Cancelar
                                </button>
                            </a>
                            <button type="submit" name="enviar" value="1" class="button--area">
                                Enviar
                            </button>
                        </div>
                        <!-- <hr>
                            <p class="text-form">Toda información será tratada de
                                manera discreta y confidencial, se asignarán las quejas/sugerencias
                                a las autoridades correspondientes, respetetando y cuidando
                                siempre su identidad dentro de la institucion. </p>
                         -->
                    </form>
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
<script type="text/javascript" src="../assets/js/utils.js"></script>
</html>
<?php mysqli_close($connection); ?>
