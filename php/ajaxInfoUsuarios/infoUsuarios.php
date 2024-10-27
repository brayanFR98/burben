<?php
require_once("../../conexion/conexion.php");

    $oid=$_POST["oid"];

    $query="SELECT u.*
    FROM usuarios u
    WHERE u.oid='".$oid."';";

    $result=mysqli_query($conexion, $query);
    if($registro=mysqli_fetch_assoc($result)){
        
        $info=json_encode($registro);
        echo $info;
    }
    else{
        echo 0;
    }
    mysqli_close($conexion);
?>