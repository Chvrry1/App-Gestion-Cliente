<?php
include 'conexion.php';
$c_idtienda=$_GET['idtienda'];
$consulta="CALL listarsolicitudesTendero('".$c_idtienda."')";
$resultado = mysqli_query($conexion,$consulta);

while($fila = mysqli_fetch_array($resultado)){
    $result["idpedido"]=$fila['IdPedido'];
    $result["importetotal"]=$fila['importetotalMX'];
    $result["horasoli"]=$fila['hora'];
    $result["fechasoli"]=$fila['fecha'];
    $result["nombrecli"]=$fila['nombres'];
    $result["appaternocli"]=$fila['apPaterno'];
    $result["apmaternocli"]=$fila['apMaterno'];
    $json['consulta'][]=$result;
}
mysqli_close($conexion);
echo json_encode($json);

?>