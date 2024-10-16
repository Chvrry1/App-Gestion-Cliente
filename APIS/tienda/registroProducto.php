<?php
 include 'conexion.php';
 $descripcion=$_POST['nombrepro'];
 $precioVTiendaMX=$_POST['precioventa'];
 $img_min=$_POST['imagen'];
 $img_max=$_POST['imagen'];
 $IdCategoria=$_POST['categoria'];
 $descuento=$_POST['promocion'];
 $Tienda=$_POST['idtienda'];

 $consulta="CALL registrarProducto('".$descripcion."','".$precioVTiendaMX."','".$img_min."','".$img_max."','".$IdCategoria."','".$descuento."','".$Tienda."')";
mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);

?>