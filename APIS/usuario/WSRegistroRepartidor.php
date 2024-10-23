<?php
include '../conexion/conexion.php';

$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $primer_apellido = $_POST['primer_apellido'] ?? null;
    $segundo_apellido = $_POST['segundo_apellido'] ?? null;
    $nombre = $_POST['nombre'] ?? null;
    $numero_id = $_POST['numero_id'] ?? null;
    $celular = $_POST['celular'] ?? null;
    $sexo = $_POST['sexo'] ?? null;
    $correo = $_POST['correo'] ?? null;
    $nombre_vehiculo = $_POST['nombre_vehiculo'] ?? null;
    $placa_vehiculo = $_POST['placa_vehiculo'] ?? null;
    $id_us = $_POST['id_us'] ?? null;
    $contrasena = $_POST['contrasena'] ?? null;

    if ($primer_apellido && $segundo_apellido && $nombre && $numero_id && $celular && $sexo && $correo && $nombre_vehiculo && $placa_vehiculo && $id_us && $contrasena) {
        $sql = "CALL spRepartidorRegistrar(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($consulta = $conexion->prepare($sql)) {
            $consulta->bind_param('sssssssssss', 
                $primer_apellido, 
                $segundo_apellido, 
                $nombre, 
                $numero_id, 
                $celular, 
                $sexo, 
                $correo, 
                $nombre_vehiculo, 
                $placa_vehiculo, 
                $id_us, 
                $contrasena
            );
            $consulta->execute();

            if ($consulta->affected_rows > 0) {
                echo json_encode(["estatus" => 200, "data" => "Registro exitoso"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(["estatus" => 204, "data" => "No se pudo registrar"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }

            $consulta->close();
        } else {
            echo json_encode(["success" => false, "error" => $conexion->error], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Faltan datos necesarios"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
} else {
    echo json_encode(["success" => false, "error" => "Método no permitido"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

$conexion->close();
?>
