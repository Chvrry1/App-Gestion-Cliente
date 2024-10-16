<?php
include 'conexion.php';
$c_total=$_GET['total'];
$c_hora=$_GET['hora'];
$c_fecha=$_GET['fecha'];
$c_comentario=$_GET['comentario'];
$c_idusuario=$_GET['idusuario'];
$c_idtienda=$_GET['idtienda'];
$c_descripcion=$_GET['descripcion'];

$consulta="CALL crearIdPedido('".$c_total."','".$c_hora."','".$c_fecha."','".$c_comentario."','".$c_idusuario."','".$c_idtienda."','".$c_descripcion."')";
$resultado = mysqli_query($conexion,$consulta);

if($resultado === FALSE) { 

  echo mysqli_error($conexion);

}else{
    if($fila = mysqli_fetch_array($resultado)){
        $result["IdPedido"]=$fila['MAX(IdPedido)'];
        $json['consulta'][]=$result;
		echo json_encode($json);
}
}

mysqli_close($conexion);


?>