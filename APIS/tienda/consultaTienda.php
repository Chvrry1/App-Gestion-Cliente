<?php

include 'conexion.php';
#$fechafinal=$_GET['fechafinal'];

$idtienda=$_GET['idtienda'];
$consulta= "select * from tbltienda where idTienda='$idtienda'";
$resultado = $conexion->query($consulta);
$numero_filas = mysqli_num_rows($resultado);
if($numero_filas<1){
	echo "Sin resultados";
	return false;
}
while($fila=$resultado->fetch_array()){
	$anuncio[]=array_map('utf8_encode',$fila);
}

echo json_encode($anuncio);
$resultado->close();
?>