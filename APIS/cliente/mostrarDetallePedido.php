<?php
include 'conexion.php';
$c_idpedido=$_GET['idpedido'];
$consulta="CALL mostrarDetallePedido('".$c_idpedido."')";
$resultado = mysqli_query($conexion,$consulta);

while($fila = mysqli_fetch_array($resultado)){
    $result["cantidad"]=$fila['cantidad'];
    $result["descripcion"]=$fila['descripcion'];
    $result["subtotal"]=$fila['subtotal'];
    $json['consulta'][]=$result;
}
mysqli_close($conexion);
echo json_encode($json);

?>