<?php
include 'conexion.php';
$c_idusuario=$_GET['idusuario'];
$c_idcategoria=$_GET['idcategoria'];
$consulta="CALL listarProductosTiendaUsuCat('".$c_idusuario."','".$c_idcategoria."')";
$resultado = mysqli_query($conexion,$consulta);

while($fila = mysqli_fetch_array($resultado)){
    $result["idtienda"]=$fila['IdTienda'];
    $result["nombreproducto"]=$fila['descripcion'];
    $result["precio"]=$fila['precioVentaMX'];
    $result["promocion"]=$fila['descuento'];
    $json['consulta'][]=$result;
}
mysqli_close($conexion);
echo json_encode($json);

?>