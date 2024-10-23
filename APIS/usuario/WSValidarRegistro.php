<?php
include '../conexion/conexion.php';

$conexion->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $identificacion = $_GET['identificacion'] ?? null;
    $email = $_GET['email'] ?? null;
    $celular = $_GET['celular'] ?? null;
    $usuario = $_GET['usuario'] ?? null;

    if ($identificacion && $email && $celular && $usuario) {
        $sql = "CALL spUsuarioValidarRegistro(?, ?, ?, ?)";

        if ($consulta = $conexion->prepare($sql)) {
            $consulta->bind_param('ssss', $identificacion, $email, $celular, $usuario);
            $consulta->execute();
            $resultado = $consulta->get_result();

            if ($resultado) {
                $row = $resultado->fetch_assoc();

                $items = [
                    'id' => intval($row['EXISTS_ID']),
                    'correo' => intval($row['EXISTS_MAIL']),
                    'celular' => intval($row['EXISTS_CELULAR']),
                    'usuario' => intval($row['EXISTS_USUARIO']),
                ];

                echo json_encode(["data" => $items, "estatus" => 200], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(["success" => false, "error" => "No se pudo obtener los resultados"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
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
