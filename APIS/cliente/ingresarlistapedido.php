<?php
include 'conexion.php';
$c_idtiendaproducto=$_GET['idtiendaproducto'];
$c_idpedido=$_GET['idpedido'];
$c_cantidad=$_GET['cantidad'];
$c_preciouniMX=$_GET['preciouniMX'];
$c_subtotal=$_GET['subtotal'];


$consulta="CALL registrarListado('".$c_idtiendaproducto."','".$c_idpedido."','".$c_cantidad."','".$c_preciouniMX."','".$c_subtotal."')";
mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);

?>