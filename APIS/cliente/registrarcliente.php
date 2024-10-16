<?php
include 'conexion.php';
$c_apPaterno=$_POST['apPaterno'];
$c_apMaterno=$_POST['apMaterno'];
$c_nombres=$_POST['nombres'];
$c_nidentificacion=$_POST['nidentificacion'];
$c_celular=$_POST['celular'];
$c_sexo=$_POST['sexo'];
$c_email=$_POST['email'];
$c_foto=$_POST['foto'];
$c_descripcion=$_POST['descripcion'];
$c_longitud=$_POST['longitud'];
$c_latitud=$_POST['latitud'];
$c_idusu=$_POST['usuario'];
$c_contraseña=$_POST['password'];



$consulta="CALL registrarCliente('".$c_apPaterno."','".$c_apMaterno."','".$c_nombres."','".$c_nidentificacion."','".$c_celular."','".$c_sexo."','".$c_email."','".$c_foto."','".$c_descripcion."','".$c_longitud."','".$c_latitud."','".$c_idusu."','".$c_contraseña."')";
mysqli_query($conexion,$consulta) or die (mysqli_error($conexion));
mysqli_close($conexion);

?>