<?php
include '../conexion/conexion.php';

$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPersona = $_POST['IdPersona'] ?? null;
    $nombre = $_POST['nombre'] ?? null;
    $primerApellido = $_POST['primerApellido'] ?? null;
    $segundoApellido = $_POST['segundoApellido'] ?? null;

    if ($idPersona && $nombre && $primerApellido && $segundoApellido) {
        $sql = "CALL spUsuarioActualizarNombreApelidos(?, ?, ?, ?)";

        if ($consulta = $conexion->prepare($sql)) {
            $consulta->bind_param('ssss', $idPersona, $nombre, $primerApellido, $segundoApellido);
            $consulta->execute();

            if ($consulta->affected_rows > 0) {
                echo json_encode(["data" => "Actualizado", "estatus" => 200], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(["data" => "No actualizado", "estatus" => 204], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
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
