<?php
include 'conexion.php';

$c_apPaterno = isset($_POST['apPaterno']) ? $_POST['apPaterno'] : '';
$c_apMaterno = isset($_POST['apMaterno']) ? $_POST['apMaterno'] : '';
$c_nombres = isset($_POST['nombres']) ? $_POST['nombres'] : '';
$c_nidentificacion = isset($_POST['nidentificacion']) ? $_POST['nidentificacion'] : '';
$c_celular = isset($_POST['celular']) ? $_POST['celular'] : '';
$c_sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
$c_email = isset($_POST['email']) ? $_POST['email'] : '';
$c_foto = isset($_POST['foto']) ? $_POST['foto'] : '';
$c_descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
$c_longitud = isset($_POST['longitud']) ? $_POST['longitud'] : '';
$c_latitud = isset($_POST['latitud']) ? $_POST['latitud'] : '';
$c_idusu = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$c_contraseña = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($c_apPaterno) || empty($c_apMaterno) || empty($c_nombres) || empty($c_nidentificacion) || empty($c_celular) || empty($c_sexo) || empty($c_email) || empty($c_idusu) || empty($c_contraseña)) {
    echo json_encode(["success" => false, "message" => "Faltan datos obligatorios."], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit();
}

$conexion->set_charset('utf8');

$sql = "CALL registrarCliente(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($consulta = $conexion->prepare($sql)) {
    $consulta->bind_param('sssssssssssss', $c_apPaterno, $c_apMaterno, $c_nombres, $c_nidentificacion, $c_celular, $c_sexo, $c_email, $c_foto, $c_descripcion, $c_longitud, $c_latitud, $c_idusu, $c_contraseña);

    if ($consulta->execute()) {
        echo json_encode(["success" => true], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["success" => false, "error" => $consulta->error], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    $consulta->close();
} else {
    echo json_encode(["success" => false, "error" => $conexion->error], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

$conexion->close();

?>
