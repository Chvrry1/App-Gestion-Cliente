<?php
include 'conexion.php';
$c_idpedido=$_GET['idpedido'];
$consulta="CALL DetallePedidoTendero('".$c_idpedido."')";
$resultado = mysqli_query($conexion,$consulta);

while($fila = mysqli_fetch_array($resultado)){
    $result["Cantidadpro"]=$fila['cantidad'];
    $result["descrippro"]=$fila['descripcion'];
    $result["PrecioUniPro"]=$fila['preciouniMX'];
    $result["Subtotalpro"]=$fila['subtotal'];
    $json['consulta'][]=$result;
}
mysqli_close($conexion);
echo json_encode($json);

?>