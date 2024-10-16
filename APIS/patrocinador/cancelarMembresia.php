<?php
include 'conexion.php';


$idusuario=$_GET['usuario'];


$consulta ="SELECT * from tblmembresias where idusuario='$idusuario'and Estado='ACTIVO'";
$resultado = mysqli_query($conexion,$consulta); 
 
 $count = mysqli_num_rows($resultado);

if($count<1){
	echo 0;
}
else{
	$consulta ="UPDATE tblmembresias SET Estado='INACTIVO' where idusuario='$idusuario'";
$resultado = mysqli_query($conexion,$consulta); 
 
 	
 

}
mysqli_close($conexion);

 ?>
