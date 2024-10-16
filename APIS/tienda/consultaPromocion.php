<?php

include 'conexion.php';
#$fechafinal=$_GET['fechafinal'];


$consulta= "select * from tblpromociones where fechafin>NOW() and fecha<NOW()  order by Id DESC";
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