<?php

include 'conexion.php';
$idusuario=$_GET['idusuario'];
#$fechafinal=$_GET['fechafinal'];

$consulta= "CALL spConsultarAnunciosSeg('".$idusuario."')";
$resultado = $conexion->query($consulta);

$numero_filas = mysqli_num_rows($resultado);

if($numero_filas<1){
	
	return false;
}
while($fila=$resultado->fetch_array()){
	$anuncio[]=array_map('utf8_encode',$fila);
}

echo json_encode($anuncio);
$resultado->close();
?>