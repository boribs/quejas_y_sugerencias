<?php
    function connect() {
        if (!($link = mysqli_connect("localhost", "root", ""))) {
            echo "Error de conexion de la base de datos.";
            exit();
        }

        if (!mysqli_select_db($link, "quejas_sugerencias_db")) {
            echo "Error seleccionando la base de datos.";
            exit();
        }
        return $link;
    }
?>
