<?php
require_once("../../conexion/conexion.php");

$oid=$_POST["oid"];

$query = "DELETE FROM usuarios WHERE oid='".$oid."'";

$result = mysqli_query($conexion, $query);

echo $result;

mysqli_close($conexion);
?>