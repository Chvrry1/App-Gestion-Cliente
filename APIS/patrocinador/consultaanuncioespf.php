<?php

include 'conexion.php';
#$fechafinal=$_GET['fechafinal'];

$idusuario=$_GET["idusuario"];

$consulta= "select * from tblanuncios where idusuario='$idusuario' order by IdAnuncio DESC";
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