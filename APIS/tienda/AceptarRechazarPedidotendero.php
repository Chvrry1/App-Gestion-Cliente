<?php
 include 'conexion.php';
 
 $IdPedido=$_POST['idpedido'];
$IdEstadoPedido=$_POST['estadopedido'];

$consulta="CALL AceptarRechazarPedidotendero('".$IdPedido."','".$IdEstadoPedido."')";
mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);



?>