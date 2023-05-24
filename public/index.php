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

        echo "<div class=\"entry\" onclick=\"location.href='#';\">
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
             </div>";
    }

    function get_entries() {
        $connection = connect();

        $query = "SELECT Id, Nombre FROM Tipo_Publicacion";
        $result = mysqli_query($connection, $query);

        $pub_types = [];
        while (($row = mysqli_fetch_array($result))) {
            $pub_types[$row["Id"]] = $row["Nombre"];
        }

        $query = "SELECT Tipo, Id_Usuario, Titulo, Comentario, Resuelto, Anonimo FROM Publicacion";
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
            <a href="https://www.buap.mx">
                <img id="BUAP-logo" src="../assets/images/logo-buap-h.png">
            </a>
            <div class="separator"></div>
            <div class="header-right header-button">
                <a href="#" class="no-decor">Contacto FCC</a>
            </div>
            <div class="header-right header-button">
                <a href="#" class="no-decor">Otra cosa</a>
            </div>
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
                        <!--
                            Si ya inició sesión:
                            <div class="d">Nueva publicación</div>
                         -->
                        <div class="forum-header-button colored">
                            <?php
                            if ($_SESSION["username"]) {
                                echo "Bienvenido, " . $_SESSION["username"];
                            } else {
                                echo "<a class=\"forum-header-button-text\" href=\"https://google.com\">Iniciar sesión</a>";
                            }
                            ?>
                        </div>
                    </header>
                    <hr>
                    <div id="forum-entries-container">
                        <!-- <p>Por el momento no hay quejas sin resolver.</p> -->
                        <!-- <div class="entry" onclick="location.href='#';">
                            <div class="entry-title-div">
                                <p class="entry-title">
                                    <span class="entry-user">Usuario 1:</span>
                                    Este es el título de la queja
                                    <span class="entry-category complaint">Queja</span>
                                </p>
                            </div>
                            <p class="entry-brief">
                                Aquí está lo primero, no entiendo por qué siempre sucede que...
                            </p>
                        </div>
                        <div class="entry" onclick="location.href='#';">
                            <div class="entry-title-div">
                                <p class="entry-title">
                                    <span class="entry-user">Usuario 2:</span>
                                    Creo que la facultad se vería mucho mejor si...
                                    <span class="entry-category suggestion">Sugerencia</span>
                                </p>
                            </div>
                            <p class="entry-brief">
                                blablablabalbalbalbalbalabalbalablablablblablablablablabla...
                            </p>
                        </div>
                        <div class="entry" onclick="location.href='#';">
                            <div class="entry-title-div">
                                <p class="entry-title">
                                    <span class="entry-user">ANONIMO:</span>
                                    El profesor XXXXXXX se la pasa diciendo tonterías en vez de dar la clase...
                                    <span class="entry-category complaint">Queja</span>
                                </p>
                            </div>
                            <p class="entry-brief">
                                blablablabalbalbalbalbalabalbalablablablblablablablablabla...
                            </p>
                        </div> -->
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
