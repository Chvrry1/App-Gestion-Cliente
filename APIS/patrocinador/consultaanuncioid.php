<?php

include 'conexion.php';
#$fechafinal=$_GET['fechafinal'];

$idanuncio=$_GET["idanuncio"];

$consulta= "select IdAnuncio, categoria, titulo, tblanuncios.descripcion, imagen, url, fechaInicio, fechaFinal, montoPagado, IdUsuario,tblcategoria.nombre as nombcat from tblanuncios INNER JOIN tblcategoria ON tblanuncios.categoria=tblcategoria.idcategoria where idanuncio=$idanuncio";
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