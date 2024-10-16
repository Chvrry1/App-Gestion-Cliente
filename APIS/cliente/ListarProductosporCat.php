<?php
include 'conexion.php';
$c_idtienda=$_GET['idtienda'];
$c_categoria=$_GET['categoria'];
$consulta="CALL mostrarProductosporCategoria('".$c_idtienda."','".utf8_decode($c_categoria)."')";
$resultado = mysqli_query($conexion,$consulta);

while($fila = mysqli_fetch_array($resultado)){
    $result["idtiendaproducto"]=$fila['IdTiendaProducto'];
    $result["descripcion"]=$fila['descripcion'];
    $result["precioventa"]=$fila['precioVTiendaMX'];
    $json['consulta'][]=$result;
}
mysqli_close($conexion);
echo json_encode($json);

?>