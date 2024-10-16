<?php
include 'conexion.php';
$c_idusuario=$_GET['idusuario'];
$consulta="CALL listarProductos('".$c_idusuario."')";
$resultado = mysqli_query($conexion,$consulta);

if($fila = mysqli_fetch_array($resultado)){
    $result["idtienda"]=$fila['IdTienda'];
    $result["nombreproducto"]=$fila['descripcion'];
    $result["precio"]=$fila['precioVentaMX'];
    $result["promocion"]=$fila['descuento'];
    $json['consulta'][]=$result;
}
mysqli_close($conexion);
echo json_encode($json);

?>