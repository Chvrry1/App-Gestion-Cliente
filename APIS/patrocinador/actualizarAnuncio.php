<?php
include 'conexion.php';


$idanuncio= $_GET['idanuncio'];
$fechainicio= $_POST['fechainicio'];
$fechafinal= $_POST['fechafinal'];
$monto= $_POST['monto']; 





    $consulta ="UPDATE tblanuncios set fechaInicio='$fechainicio', fechafinal='$fechafinal', montoPagado='$monto' where idanuncio='$idanuncio'";
 mysqli_query($conexion,$consulta); 
$resultado = (mysqli_error($conexion));
mysqli_close($conexion);
 echo $resultado;
 
