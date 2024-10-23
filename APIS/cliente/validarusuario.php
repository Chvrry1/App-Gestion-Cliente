<?php
include 'conexion.php';

$u_usuario = $_POST['usuario'];
$u_password = $_POST['password'];

//$u_usuario='duran';
//$u_password='12345';

$conexion->set_charset('utf8');

$sql = "CALL validarUsuarios(?, ?)";

if ($consulta = $conexion->prepare($sql)) {
	
    $consulta->bind_param('ss', $u_usuario, $u_password);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($fila = $resultado->fetch_assoc()) {
        echo json_encode($fila, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    $consulta->close();
    $conexion->close();
} else {
    $error = $conexion->errno . ' ' . $conexion->error;
    echo $error;
}
?>
