<?php

include 'conexion.php';
$c_idusuario=$_GET['idusuario'];
$consulta="CALL consultaTendero('".$c_idusuario."')";
  
 mysqli_set_charset($conexion,"utf8");
$resultado = mysqli_query($conexion,$consulta);

if($fila = mysqli_fetch_array($resultado)){
    $result["usuario"]=$fila['IdUsuario'];
    $result["nombre"]=$fila['nombres'];
    $result["appaterno"]=$fila['apPaterno'];
    $result["apmaterno"]=$fila['apmaterno'];
    $result["tienda"]=$fila['nombre'];
    $result["idtienda"]=$fila['IdTienda'];
    $json['consulta'][]=$result;
}
mysqli_close($conexion);
echo json_encode($json,JSON_UNESCAPED_UNICODE);


?>