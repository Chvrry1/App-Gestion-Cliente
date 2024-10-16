<?php
include 'conexion.php';


$idusuario=$_GET['usuario'];


$consulta ="SELECT * from tblmembresias where idusuario='$idusuario' and Estado='ACTIVO'";
$resultado = mysqli_query($conexion,$consulta); 
 
 $count = mysqli_num_rows($resultado);

if($count<1){
	echo 0;
}
else{
	
while($fila = mysqli_fetch_array($resultado, MYSQLI_NUM)){
	 echo $fila[1];
}
 

}
mysqli_close($conexion);

 ?>
