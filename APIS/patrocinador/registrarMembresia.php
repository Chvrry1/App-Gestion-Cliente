<?php
include 'conexion.php';

$nivel=$_POST['nivel'];
$idusuario=$_POST['usuario'];
$fecha=$_POST['fecha'];



$consulta ="SELECT * from tblmembresias where idusuario='$idusuario'";
$resultado = mysqli_query($conexion,$consulta); 
 
 $count = mysqli_num_rows($resultado);

if($count<1){
	$consulta ="INSERT INTO tblmembresias(nivel,idusuario,fechaRegistro,estado) Values($nivel,'$idusuario','$fecha','ACTIVO')";
 mysqli_query($conexion,$consulta); 
}
else{
	


$consulta ="SELECT * from tblmembresias where idusuario='$idusuario' and nivel=$nivel and estado='ACTIVO'";
$resultado = mysqli_query($conexion,$consulta); 
 
 $count = mysqli_num_rows($resultado);

if($count>0){
	echo 'Ya tienes este plan';
	return false;
}else{
	$consulta ="UPDATE tblmembresias SET nivel=$nivel,fechaRegistro='$fecha',estado='ACTIVO' where idusuario='$idusuario'";
	mysqli_query($conexion,$consulta); 
	echo 'Se actualizo el plan';
}




}
mysqli_close($conexion);

 ?>
