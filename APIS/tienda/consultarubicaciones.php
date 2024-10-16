<?php

include 'conexion.php';
#$fechafinal=$_GET['fechafinal'];
$con = mysqli_connect('localhost','root','1234','dbencargalo') or die('Unable to Connect...');
$idTienda=$_GET["idtienda"] ;

$consulta= "select tblubicacionentrega.latitud, tblubicacionentrega.longitud, tblubicacionentrega.descripcion from tblpedido inner join tblubicacionentrega ON tblpedido.IdUbicacionE = tblubicacionentrega.IdUbicacionE where idTienda = '$idTienda'";
$resultado = $con->query($consulta);
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