<?php
    session_start();
    require('conexion.php');
    $connection = connect();

    $email = $_REQUEST['correo'];
    $clave = $_REQUEST['clave'];

    echo("-$email-<br>");
    echo("-$clave-<br>");
    /*Generar un query para que mande el email y el nombre del ususario el cual sera usado para que muestre en pantalla lo que es */

    $query = "SELECT COUNT(*) as contar FROM usuario WHERE correo = '$email' AND contrasena = '$clave'";
    $result = mysqli_query($connection, $query);
    
    if ($result === false) 
    {
        echo "Error en la consulta: " . mysqli_error($connection);
        exit;
    }

    $array = mysqli_fetch_array($result);
    if($array && $array['contar'] > 0) 
    {
        $_SESSION['email'] = $email;
        header("location: ../../public/index.php");
        exit();
    }
    else 
    { 
        echo "Usuario o contraseña incorrectos. Por favor, inténtelo de nuevo.";
        header("location: ../../public/login.php");
    }
    mysqli_close($connection);
?>