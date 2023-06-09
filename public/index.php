<?php
    session_start();
    require('../src/connection.php');

    function create_entry_dom($row) {
        $username = $row["Usuario"];
        $title = $row["Titulo"];
        $content = $row["Comentario"];
        if (strlen($content) > 150) {
            $content = substr($content, 0, 150) . "...";
        }
        $type = $row["Tipo"];
        $type_class = strtolower($type);
        $pub_id = $row["Id"];

        echo "<a class=\"entry no-decor\" href=\"publicacion.php?id=$pub_id\">
                 <div class=\"entry-title-div\">
                     <p class=\"entry-title\">
                         <span class=\"entry-user\">$username:</span>
                         $title
                         <span class=\"entry-category $type_class\">$type</span>
                     </p>
                 </div>
                 <p class=\"entry-brief\">
                     $content
                 </p>
             </a>";
    }

    function get_entries() {
        $connection = connect();

        $query = "SELECT Id, Nombre FROM Tipo_Publicacion";
        $result = mysqli_query($connection, $query);

        $pub_types = [];
        while (($row = mysqli_fetch_array($result))) {
            $pub_types[$row["Id"]] = $row["Nombre"];
        }

        $resuelto = array_key_exists("resuelto", $_GET) ? "TRUE" : "FALSE";

        $query = "SELECT * FROM Publicacion WHERE Resuelto = $resuelto";
        $result = mysqli_query($connection, $query);

        while (($row = mysqli_fetch_array($result))) {
            if (!$row["Anonimo"]) {
                $user = mysqli_fetch_array(
                    mysqli_query(
                        $connection,
                        "SELECT Nombre FROM Usuario WHERE Id = " . $row['Id_Usuario']
                    )
                );
                $row["Usuario"] = $user[0];
            } else {
                $row["Usuario"] = "Anónimo";
            }

            $row["Tipo"] = $pub_types[$row["Tipo"]];
            create_entry_dom($row);
        }
        mysqli_close($connection);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../assets/css/index.css">
    <title>Quejas FCC</title>
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
                <h1>FORO DE QUEJAS: FCC</h1>
                <h2>Tu opinión nos interesa</h2>

                <div id="forum-container">
                    <header id="forum-header" class="row">
                        <div class="forum-header-button">
                            <input type="text" id="search-bar" placeholder=" ">
                            <label for="" id="search-bar-label">Buscar</label>
                            <div id="search-bar-button"><img src="../assets/images/icono-buscar.png"></div>
                        </div>
                        <div class="separator"></div>
                        <?php
                        if (array_key_exists("username", $_SESSION)) {
                            echo "<div class=\"forum-header-button colored\">";
                            if (array_key_exists("resuelto", $_GET)) {
                                echo "<a class=\"forum-header-button-text\" href=\"index.php\">Publicaciones pendientes</a>";
                            } else {
                                echo "<a class=\"forum-header-button-text\" href=\"index.php?resuelto=1\">Publicaciones resueltas</a>";
                            }
                            echo "</div>";
                        }
                        ?>
                        <div class="forum-header-button colored">
                            <?php
                            if (array_key_exists("username", $_SESSION)) {
                                echo "<a class=\"forum-header-button-text\" href=\"nuevapublicacion.php\">Nueva publicación</a>";
                            } else {
                                echo "<a class=\"forum-header-button-text\" href=\"login.html\">Iniciar sesión</a>";
                            }
                            ?>
                        </div>
                    </header>
                    <hr>
                    <div id="forum-entries-container">
                        <?php get_entries(); ?>
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

