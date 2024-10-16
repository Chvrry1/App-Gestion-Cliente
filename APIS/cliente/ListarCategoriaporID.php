<?php
include 'conexion.php';
$c_idtienda=$_GET['idtienda'];
$consulta="CALL ListarCategoriasTiendaPorID('".$c_idtienda."')";
$resultado = mysqli_query($conexion,$consulta);

while($fila = mysqli_fetch_array($resultado)){
    $result["categoria"]=utf8_encode($fila['nombre']);
    $json['consulta'][]=$result;
}
mysqli_close($conexion);
echo json_encode($json);

?>