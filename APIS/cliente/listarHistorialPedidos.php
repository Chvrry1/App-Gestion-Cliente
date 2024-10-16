<?php
include 'conexion.php';
$c_idusuario=$_GET['idusuario'];
$consulta="CALL listarhistorialpedidos('".$c_idusuario."')";
$resultado = mysqli_query($conexion,$consulta);

while($fila = mysqli_fetch_array($resultado)){
    $result["Num"]=$fila['Num'];
    $result["fecha"]=$fila['fecha'];
    $result["nombre"]=$fila['nombre'];
    $result["importetotalMX"]=$fila['importetotalMX'];
    $result["nombreEstado"]=$fila['nombreEstado'];
    $result["IdPedido"]=$fila['IdPedido'];
    $json['consulta'][]=$result;
}
mysqli_close($conexion);
echo json_encode($json);

?>