<?php
include 'conexion.php';
$c_idusuario=$_GET['idusuario'];
$consulta="CALL consultarUsuario('".$c_idusuario."')";
$resultado = mysqli_query($conexion,$consulta);

if($fila = mysqli_fetch_array($resultado)){
    $result["nombres"]=$fila['nombres'];
    $result["ubicacion"]=$fila['descripcion'];
    $json['consulta'][]=$result;
}
mysqli_close($conexion);
echo json_encode($json);

?>