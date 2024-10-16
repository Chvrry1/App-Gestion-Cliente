<?php
include 'conexion.php';


$idusuario=$_GET['usuario'];


$consulta ="SELECT tbldetallemembresia.Nombre from tblmembresias INNER JOIN tbldetallemembresia ON tbldetallemembresia.id = tblmembresias.nivel  where idusuario='$idusuario' and Estado='ACTIVO'";
$resultado = mysqli_query($conexion,$consulta); 
 
 $count = mysqli_num_rows($resultado);

if($count<1){
	echo '-';
}
else{
	
while($fila = mysqli_fetch_array($resultado, MYSQLI_NUM)){
	 echo $fila[0];
}
 

}
mysqli_close($conexion);

 ?>
