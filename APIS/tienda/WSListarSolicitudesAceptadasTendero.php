<?php
include 'conexion.php';
$c_idtienda=$_GET['idtienda'];
$consulta="CALL listarsolicitudesAceptadasTendero('".$c_idtienda."')";
$resultado = mysqli_query($conexion,$consulta);

while($fila = mysqli_fetch_array($resultado)){
    $result["idpedidoAc"]=$fila['IdPedido'];
    $result["importetotalAc"]=$fila['importetotalMX'];
    $result["horasoliAc"]=$fila['hora'];
    $result["fechasoliAc"]=$fila['fecha'];
    $result["nombrecliAc"]=$fila['nombres'];
    $result["appaternocliAc"]=$fila['apPaterno'];
    $result["apmaternocliAc"]=$fila['apMaterno'];
    $result["nombreestado"]=$fila['nombreEstado'];

    $json['consulta'][]=$result;
}
mysqli_close($conexion);
echo json_encode($json);

?>