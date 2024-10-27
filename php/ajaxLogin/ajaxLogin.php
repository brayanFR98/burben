<?php
session_start();

if (isset($_POST["email"]) && isset($_POST["pass"])) {
    require_once("../../conexion/conexion.php");

    $query = "SELECT *
        FROM usuarios u
        WHERE u.email='" . $_POST["email"] . "' 
        AND u.password=MD5('" . $_POST["pass"] . "');";
    $result = mysqli_query($conexion, $query) or die("Error en la consulta: " . mysqli_error($conexion));

    if (mysqli_num_rows($result) == 1) {
        $email = $_POST["email"];
        $pass = $_POST["pass"];

        $usuario = mysqli_fetch_assoc($result);

        $_SESSION["oid"] = $usuario["oid"];
        $_SESSION["nombre"] = $usuario["name"];
        $_SESSION["telefono"] = $usuario["telephone"];
        $_SESSION["rfc"] = $usuario["rfc"];
        $_SESSION["email"] = $usuario["email"];
        $_SESSION["nota"] = $usuario["notes"];

        if ($_SESSION["oid"]) {
            echo "1";
            exit();
        }
    } else {
        echo "2";
        exit();
    }
}
mysqli_close($conexion);

?>