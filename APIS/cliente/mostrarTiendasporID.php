<?php
include 'conexion.php';
$c_idrubro=$_GET['idrubro'];
$consulta="CALL listarTiendaporRubro('".$c_idrubro."')";
$resultado = mysqli_query($conexion,$consulta);

while($fila = mysqli_fetch_array($resultado)){
    $result["idtienda"]=$fila['IdTienda'];
    $result["nombre"]=$fila['nombre'];
    $result["ubicacion"]=$fila['descripcionubicacion'];
    $result["calificacion"]=$fila['calificacion'];
    $json['consulta'][]=$result;
}
mysqli_close($conexion);
echo json_encode($json);

?>