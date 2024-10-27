<?php
session_start();
require_once("../conexion/conexion.php");

$queryTabla = "SELECT name, telephone, email, rfc, notes FROM usuarios ORDER BY name";
$resultTabla = mysqli_query($conexion, $queryTabla) or die("Error en la consulta: " . mysqli_error($conexion));

$usuarios = [];
while ($info = mysqli_fetch_assoc($resultTabla)) {
    $usuarios[] = $info;
}

echo json_encode($usuarios); // Envía los datos como JSON para JavaScript
?>
