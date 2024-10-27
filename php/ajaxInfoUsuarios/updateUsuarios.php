<?php
require_once("../../conexion/conexion.php");

$oidUser = $_POST["oidUser"];
$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];
$rfc = $_POST["rfc"];
$correo = $_POST["correo"];
$pass = $_POST["pass"];
$notas = $_POST["notas"];

if (strlen($nombre) <= 2) {
    echo "2";
    exit;
}
if (strlen($nombre) >= 101) {
    echo "3";
    exit;
}

if (strlen($telefono) <= 13) {
    echo "4";
    exit;
}
if (strlen($telefono) >= 15) {
    echo "5";
    exit;
}
if (strlen($rfc) <= 12) {
    echo "12";
    exit;
}
if (strlen($rfc) >= 14) {
    echo "13";
    exit;
}
if (strlen($correo) <= 4) {
    echo "6";
    exit;
}
if (strlen($correo) >= 100) {
    echo "7";
    exit;
}
if (strlen($notas) >= 501) {
    echo "10";
    exit;
}
$queryverifytel = "SELECT * FROM usuarios WHERE telephone='" . $telefono . "' AND oid != '" . $oidUser . "';";
$resultverifytel = mysqli_query($conexion, $queryverifytel) or die("Error en la consulta: " . mysqli_error($conexion));

$queryverifyemail = "SELECT * FROM usuarios WHERE email='" . $correo . "' AND oid != '" . $oidUser . "';";
$resultverifyemail = mysqli_query($conexion, $queryverifyemail) or die("Error en la consulta: " . mysqli_error($conexion));

if (mysqli_num_rows($resultverifytel) == 1) {
    echo "11";
    exit;
} else if (mysqli_num_rows($resultverifyemail) == 1) {
    echo "14";
    exit;
} else {
    if ($pass != "") {
        if (strlen($pass) <= 7) {
            echo "8";
            exit;
        }
        if (strlen($pass) >= 30) {
            echo "9";
            exit;
        }
        $query = "UPDATE usuarios SET name=TRIM('" . $nombre . "'), telephone=TRIM('" . $telefono . "'), 
        email=TRIM('" . $correo . "'), rfc=TRIM('" . $rfc . "'), notes=TRIM('" . $notas . "'),
        password=MD5('" . $pass . "')
        WHERE oid='" . $oidUser . "';";
    } else {

        $query = "UPDATE usuarios SET name=TRIM('" . $nombre . "'), telephone=TRIM('" . $telefono . "'),
    email=TRIM('" . $correo . "'), rfc=TRIM('" . $rfc . "'), notes=TRIM('" . $notas . "') 
    WHERE oid='" . $oidUser . "';";
    }
    $result = mysqli_query($conexion, $query) or die("la consulta fallo: " . mysqli_error($conexion));

    echo $result;

}

mysqli_close($conexion);
?>