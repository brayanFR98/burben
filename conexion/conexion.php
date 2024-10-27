<?php
$servername = "localhost";
$database = "burben";
$username = "root";   
$password = "";  


$conexion = mysqli_connect($servername, $username, $password, $database);
$conexion -> set_charset("utf8");//para corregir error de que la BD no muestra los acentos y las Ñ.
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
// mysqli_close($conn);

?>