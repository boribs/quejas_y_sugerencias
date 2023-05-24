<?php
    session_start();
    require('connection.php');
    $connection = connect();

    $email = $_REQUEST['correo'];
    $clave = $_REQUEST['clave'];

    echo("-$email-<br>");
    echo("-$clave-<br>");

    $query = "SELECT Nombre FROM usuario WHERE correo = '$email' AND contrasena = '$clave'";
    $result = mysqli_query($connection, $query);

    if ($result === false) {
        echo "Error en la consulta: " . mysqli_error($connection);
        exit;
    }

    $array = mysqli_fetch_array($result);
    if($array) {
        $_SESSION['username'] = $array["Nombre"];
        header("location: ../../public/index.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos. Por favor, inténtelo de nuevo.";
        header("location: ../../public/login.html");
    }

    mysqli_close($connection);
?>
