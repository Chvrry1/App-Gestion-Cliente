
<?php
include 'conexion.php';
$u_usuario=$_POST['usuario'];
$u_password=$_POST['password'];
//$u_usuario='duran';
//$u_password='12345';
$conexion->set_charset('utf8');
$sql="SELECT IdUsuario, contraseña
                            FROM tblusuario
                            INNER JOIN tbltipousuario ON tblusuario.IdTUsuario = tbltipousuario.IdTUsuario
                            WHERE tbltipousuario.descripcion ='TENDERO' AND IdUsuario=? AND contraseña=?";

						

if($consulta = $conexion->prepare($sql)) { // assuming $mysqli is the connection
   $consulta->bind_param('ss',$u_usuario,$u_password);
	$consulta->execute();
	$resultado=$consulta->get_result();
	if($fila = $resultado -> fetch_assoc()){
			echo json_encode($fila,JSON_UNESCAPED_UNICODE);
	}
	$consulta->close();
	$conexion->close();
		// any additional code you need would go here.
} else {
    $error = $conexion->errno . ' ' . $conexion->error;
    echo $error; // 1054 Unknown column 'foo' in 'field list'
}



?>